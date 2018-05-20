# -*- mode: ruby -*-
# vi: set ft=ruby :


Vagrant.configure("2") do |config|

  config.vm.box = "debian/stretch64"

  config.vm.synced_folder '.', '/vagrant', type:"virtualbox"
  config.vm.network "private_network", ip: "192.168.57.10"

  config.vm.provision "shell", path: "./provision/setup-mysql.sh"
end
