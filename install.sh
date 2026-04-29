#!/bin/bash

# 1. 拷贝核心文件到 /link 目录
rm /link -r 2>/dev/null
cp `pwd` /link -a

# 2. 安装系统依赖 (已适配 Ubuntu 24.04)
# 备注：更新了 Qt5 的 t64 包名，并将过时的 ntp 替换为 chrony
apt update
apt install libqt5core5t64 libqt5network5t64 libqt5test5t64 libqt5websockets5 php-fpm chrony -y

# 3. 动态识别 PHP 版本并拷贝配置文件
# 获取当前安装的 PHP 主版本号和次版本号 (例如 8.3)
PHP_VER=$(php -r "echo PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION;")
if [ -d "/etc/php/$PHP_VER/fpm/pool.d" ]; then
    cp /link/config/www.conf /etc/php/$PHP_VER/fpm/pool.d/www.conf
    echo "PHP-FPM 配置文件已成功应用到 PHP $PHP_VER"
else
    echo "警告：未找到 /etc/php/$PHP_VER/fpm/pool.d 目录，请手动检查 PHP 安装。"
fi

# 4. 拷贝动态链接库并赋予权限
cp ./lib/* /usr/lib/ -a
chmod 777 /link/config/ -R

# 确保主控脚本有执行权限
chmod +x /link/shell/init.sh

# 5. 配置 systemd 开机自启动 (替代旧版的 rc.local)
cat <<EOF > /etc/systemd/system/linkpiserv.service
[Unit]
Description=LinkPi Service AutoStart
After=network-online.target

[Service]
Type=oneshot
RemainAfterExit=yes
ExecStart=/link/shell/init.sh

[Install]
WantedBy=multi-user.target
EOF

# 重新加载 systemd 守护进程并设置开机自启
systemctl daemon-reload
systemctl enable linkpiserv.service

# 同步文件系统缓存
sync

echo "====================================="
echo "安装完成！请重启服务器 (执行 reboot)。"
echo "====================================="
