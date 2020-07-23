@servers(['web' => 'root@119.23.220.39'])

@task('fang')
    cd /www/wwwroot/fang
    git pull
@endtask
