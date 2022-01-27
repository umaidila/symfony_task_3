git commit -a -m "prod deploy"
git push
ssh root@91.203.192.213 'sh /var/www/html/project_prod/Scripts/build.sh'