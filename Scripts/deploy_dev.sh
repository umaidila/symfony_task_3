git commit -a -m "dev deploy"
git push
ssh root@91.203.192.213 'sh /var/www/html/project_dev/Scripts/build.sh'