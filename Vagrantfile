# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure('2') do |config|
    config.vm.box       = 'debian/jessie64'
    config.vm.host_name = 'minecraft.dev'
    config.ssh.forward_agent = true

    config.vm.network 'private_network', ip: '192.168.142.42'
    config.vm.network 'forwarded_port', guest: 3306, host: 3306
    config.vm.synced_folder '.', '/srv/share', id: 'vagrant-share', :nfs => true
    config.vm.synced_folder '.', '/vagrant'

    config.vm.provider :virtualbox do |virtualbox|
        virtualbox.customize ['modifyvm', :id, '--memory', 4096]
    end

    config.vm.provision 'ansible_local' do |ansible|
        ansible.install_mode      = 'pip'
        ansible.version           = "2.2.1"
        ansible.playbook          = 'ansible/site.yml'
        ansible.inventory_path    = 'ansible/inventory/devbox/hosts'
        ansible.limit             = 'devbox'
    end
end
