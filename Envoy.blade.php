@servers(['web' => 'ubuntu@smgdev.top'])

@setup
$repository = 'git@gitlab.com:asia-dev/e-commerce-api.git';
$releases_dir = '/var/www/ecommerce-api/releases';
$app_dir = '/var/www/ecommerce-api';
$release = date('YmdHis');
$branch = 'main';
$new_release_dir = $releases_dir .'/'. $release;
@endsetup

@task('clone_repository')
echo 'Cloning repository'
[ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
cd {{ $new_release_dir }}
git pull origin {{ $branch }}
git reset --hard {{ $commit }}
@endtask

@task('run_composer')
echo "Starting deployment ({{ $release }})"
cd {{ $new_release_dir }}
composer install --prefer-dist --no-scripts -q -o
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

@task('setup_laravel')
cd {{ $app_dir }}/current
php artisan migrate --force
php artisan storage:link
@endtask

@story('deploy')
clone_repository
run_composer
update_symlinks
setup_laravel
@endstory