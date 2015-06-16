# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.box = "wheezy"

   config.vm.box_url = "http://stajp.vtszg.hr/DWA/download/DWA3.box"
#   config.vm.box_url = "DWA3.box"

   config.vm.network :forwarded_port,  guest: 80, host: 8001
   config.vm.network :public_network, ip: "192.168.0.200"
   
  config.vm.synced_folder "./", "/vagrant", :mount_options => ["dmode=777","fmode=666"]

  config.vm.provider :virtualbox do |vb|
    vb.customize ["modifyvm", :id, "--memory", "256"]
  end

#  config.vm.provision :shell, :inline => $script

end


