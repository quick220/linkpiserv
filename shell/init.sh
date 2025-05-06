sysctl -w net.core.rmem_max=5000000
sysctl -w net.core.rmem_default=5000000
/link/shell/loop.sh /link/bin/Intercom &
/link/shell/loop.sh /link/shell/sls.sh &
/link/bin/frps -c /link/config/frps.ini &
/link/shell/loop.sh /link/bin/MPServer &
/link/other/nginx/sbin/nginx -p /link/other/nginx
