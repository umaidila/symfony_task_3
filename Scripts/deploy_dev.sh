git commit -a -m "[8] dev deploy"
git push
ssh root@91.203.192.213 'cd /var/www/html/project_dev/Scripts && bash build.sh'