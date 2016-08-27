# Deployment instuctions  

```{r, engine='bash', deployment_script}
cd <project_root>
git clone git@git.kartpay.com:Freelancers/Jindal-Auto-Laravel.git .
composer install
edit the .env File with the DB Details in case of Cluster
php artisan dashboard:setup 
```




