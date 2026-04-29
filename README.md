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
