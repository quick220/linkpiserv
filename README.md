# Service

## 介绍
LinkPi云服务相关免费软件的快速部署。

包含集成通信系统、frp、nginx-rtmp、sls，未来还会扩展更多常用流媒体服务软件。

## 运行环境
Ubuntu Server 24.04 (已完成脚本适配与测试)

## 安装教程

请以 **root** 用户登录你的服务器并执行以下命令：

```bash
# 更新系统索引
apt update

# 安装 git 工具
apt install git -y

# 克隆仓库到本地
git clone https://github.com/quick220/linkpiserv.git

# 进入目录并执行安装脚本
cd linkpiserv
chmod +x install.sh
./install.sh

# 安装完成后重启服务器以生效
reboot
服务说明
Intercom
集成通信服务端程序，默认占用 UDP 7000 端口

frp
内网穿透程序，默认占用 TCP 7000 端口

nginx-rtmp
rtmp服务端，默认占用 TCP 1935 端口

推/拉流地址：rtmp://ServerIP/live/XXXX

sls
SRT Liver Server, 默认占用 UDP 8080 端口

推流地址：srt://ServerIP:8080?streamid=push/live/XXXX
拉流地址：srt://ServerIP:8080?streamid=pull/live/XXXX

服务配置
修改 /link/config 目录下的配置文件即可。


---

### 后续建议
1. **更新 README.en.md**：如果你需要同时维护英文文档，建议将上面的内容翻译并更新到 `README.en.md` 中。
2. **提交更改**：
   ```bash
   git add README.md install.sh
   git commit -m "Update: adaptation for Ubuntu 24.04 and update repository URLs"
   git push origin main
如果有任何关于代码逻辑或配置的进一步问题，欢迎随时咨询！
