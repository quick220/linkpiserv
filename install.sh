rm /link -r 2>/dev/null
cp `pwd` /link -a

if [ ! -f "/etc/rc.local" ]; then
echo "#!/bin/sh -e" > /etc/rc.local
chmod 777 /etc/rc.local
fi

if [ `grep -c "/link/shell/init.sh" /etc/rc.local` -eq '0' ];then
    echo -e "\n/link/shell/init.sh &\n" >> /etc/rc.local
fi

apt install libqt5core5a libqt5network5 libqt5test5 libqt5websockets5 php-fpm ntp -y

#if [ `grep -c "rtmp.conf" /etc/nginx/nginx.conf` -eq '0' ];then
#    echo -e "\ninclude /link/config/rtmp.conf;\n" >> /etc/nginx/nginx.conf
#fi

cp /link/config/www.conf /etc/php/7.2/fpm/pool.d/www.conf
cp ./lib/* /usr/lib/ -a
chmod 777 /link/config/ -R

sync
