#!/usr/bin/env bash

# Give us a 1GB swap file
# See: https://programmaticponderings.wordpress.com/2013/12/19/scripting-linux-swap-space/
create_swap() {
    # size of swapfile in megabytes
    swapsize=1024

    # does the swap file already exist?
    grep -q "swapfile" /etc/fstab
 
    # if not then create it
    if [ $? -ne 0 ]; then
        echo 'swapfile not found. Adding swapfile.'
        fallocate -l ${swapsize}M /swapfile
        chmod 600 /swapfile
        mkswap /swapfile
        swapon /swapfile
        echo '/swapfile none swap defaults 0 0' >> /etc/fstab
    else
        echo 'swapfile found. No changes made.'
    fi
 
    # output results to terminal
    cat /proc/swaps
    cat /proc/meminfo | grep Swap
}
create_swap

apt-get update
apt-get install -y vim

# Pretty command line
echo "export CLICOLOR=1" >> /home/ubuntu/.bashrc
echo "export LSCOLORS=GxFxCxDxBxegedabagaced" >> /home/ubuntu/.bashrc
echo 'export PS1="\u@\[\e[32;1m\]\H \[\e[0m\]\w\$ "' >> /home/ubuntu/.bashrc
echo 'cd /vagrant' >> /home/ubuntu/.bashrc

# @note without `vagrant fs-notify`, we need to rely on --force_polling, which is slow and seems to cause a memory leak.
# Thankfully, that plugin helps, so we don't need it: https://github.com/adrienkohlbecker/vagrant-fsnotify
echo 'alias runserver="cd /vagrant && jekyll serve --host=0.0.0.0"' >> /home/ubuntu/.bashrc
echo 'alias runserver="sudo pkill jekyll"' >> /home/ubuntu/.bashrc

. ~/.bashrc

# Install Ruby
sudo apt-get install -y ruby ruby-dev make gcc

# Node
sudo curl -sL https://deb.nodesource.com/setup_7.x | sudo -E bash -
sudo apt-get -y install nodejs
sudo ln -s $(which nodejs) /usr/bin/node

# Need to run and choose latest version of Ruby:
sudo update-alternatives --config ruby

# Jekyll
sudo gem update --system 2.6.12 # fixes problem with bundler install - not sure why the version # needs to be specified
gem install jekyll bundler