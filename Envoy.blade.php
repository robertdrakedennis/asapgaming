@servers(['web' => 'deployer@158.69.123.213'])

@setup
$repository = 'git@gitlab.com:weeb-cafe/www.git';
    $releases_dir = '/var/www/weeb/releases';
    $app_dir = '/var/www/weeb';
    $release = date('YmdHis');
    $new_release_dir = $releases_dir .'/'. $release;
    @endsetup

    @story('deploy')
    clone_repository
    run_composer
    run_yarn
    update_symlinks
    composer_and_install
    @endstory

    @task('clone_repository')
    echo 'Cloning repository'
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
    cd {{ $releases_dir }}
    git reset --hard {{ $commit }}
    @endtask

    @task('run_composer')
    echo "Starting deployment ({{ $release }})"
    cd {{ $new_release_dir }}
    composer install --prefer-dist --no-scripts -q -o
    @endtask

    @task('run_yarn')
    echo "Starting yarn.. ({{ $release }})"
    yarn
    yarn prod
    @endtask

    @task('update_symlinks')
    echo "Linking storage directory"
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $app_dir }}/storage {{ $new_release_dir }}/storage

    echo 'Linking .env file'
    ln -nfs {{ $app_dir }}/.env {{ $new_release_dir }}/.env

    echo 'Linking current release'
    ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current
    @endtask

    @task('composer_and_migrate')
    composer install
    php artisan migrate
    @endtask
