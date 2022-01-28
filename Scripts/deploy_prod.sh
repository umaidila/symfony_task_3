git commit -a -m "[9] prod deploy"
git push
ssh root@91.203.192.213 'cd /var/www/html/project_prod/Scripts && bash build.sh'