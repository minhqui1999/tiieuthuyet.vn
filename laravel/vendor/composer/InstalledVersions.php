<?php











namespace Composer;

use Composer\Autoload\ClassLoader;
use Composer\Semver\VersionParser;






class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => '1.0.0+no-version-set',
    'version' => '1.0.0.0',
    'aliases' => 
    array (
    ),
    'reference' => NULL,
    'name' => 'laravel/laravel',
  ),
  'versions' => 
  array (
    'classpreloader/classpreloader' => 
    array (
      'pretty_version' => '3.2.1',
      'version' => '3.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '297db07cabece3946f4a98d23f11f90aa10e1797',
    ),
    'cordoval/hamcrest-php' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'davedevelopment/hamcrest-php' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'dnoegel/php-xdg-base-dir' => 
    array (
      'pretty_version' => '0.1',
      'version' => '0.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '265b8593498b997dc2d31e75b89f053b5cc9621a',
    ),
    'doctrine/inflector' => 
    array (
      'pretty_version' => '1.4.3',
      'version' => '1.4.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '4650c8b30c753a76bf44fb2ed00117d6f367490c',
    ),
    'doctrine/instantiator' => 
    array (
      'pretty_version' => '1.4.0',
      'version' => '1.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd56bf6102915de5702778fe20f2de3b2fe570b5b',
    ),
    'fzaninotto/faker' => 
    array (
      'pretty_version' => 'v1.9.2',
      'version' => '1.9.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '848d8125239d7dbf8ab25cb7f054f1a630e68c2e',
    ),
    'guzzlehttp/guzzle' => 
    array (
      'pretty_version' => '6.5.5',
      'version' => '6.5.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '9d4290de1cfd701f38099ef7e183b64b4b7b0c5e',
    ),
    'guzzlehttp/promises' => 
    array (
      'pretty_version' => '1.4.1',
      'version' => '1.4.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '8e7d04f1f6450fef59366c399cfad4b9383aa30d',
    ),
    'guzzlehttp/psr7' => 
    array (
      'pretty_version' => '1.7.0',
      'version' => '1.7.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '53330f47520498c0ae1f61f7e2c90f55690c06a3',
    ),
    'hamcrest/hamcrest-php' => 
    array (
      'pretty_version' => 'v1.2.2',
      'version' => '1.2.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b37020aa976fa52d3de9aa904aa2522dc518f79c',
    ),
    'illuminate/auth' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/broadcasting' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/bus' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/cache' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/config' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/console' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/container' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/contracts' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/cookie' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/database' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/encryption' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/events' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/exception' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/filesystem' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/hashing' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/http' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/log' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/mail' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/pagination' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/pipeline' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/queue' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/redis' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/routing' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/session' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/support' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/translation' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/validation' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'illuminate/view' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'jakub-onderka/php-console-color' => 
    array (
      'pretty_version' => 'v0.2',
      'version' => '0.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd5deaecff52a0d61ccb613bb3804088da0307191',
    ),
    'jakub-onderka/php-console-highlighter' => 
    array (
      'pretty_version' => 'v0.3.2',
      'version' => '0.3.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '7daa75df45242c8d5b75a22c00a201e7954e4fb5',
    ),
    'jeremeamia/superclosure' => 
    array (
      'pretty_version' => '2.4.0',
      'version' => '2.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '5707d5821b30b9a07acfb4d76949784aaa0e9ce9',
    ),
    'kodova/hamcrest-php' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'kylekatarnls/update-helper' => 
    array (
      'pretty_version' => '1.2.1',
      'version' => '1.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '429be50660ed8a196e0798e5939760f168ec8ce9',
    ),
    'laravel/framework' => 
    array (
      'pretty_version' => 'v5.2.45',
      'version' => '5.2.45.0',
      'aliases' => 
      array (
      ),
      'reference' => '2a79f920d5584ec6df7cf996d922a742d11095d1',
    ),
    'laravel/laravel' => 
    array (
      'pretty_version' => '1.0.0+no-version-set',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => NULL,
    ),
    'laravel/socialite' => 
    array (
      'pretty_version' => 'v2.0.22',
      'version' => '2.0.22.0',
      'aliases' => 
      array (
      ),
      'reference' => '67154ff06a43169a2efa28d870344a3a61c36bee',
    ),
    'league/flysystem' => 
    array (
      'pretty_version' => '1.1.3',
      'version' => '1.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '9be3b16c877d477357c015cec057548cf9b2a14a',
    ),
    'league/mime-type-detection' => 
    array (
      'pretty_version' => '1.7.0',
      'version' => '1.7.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '3b9dff8aaf7323590c1d2e443db701eb1f9aa0d3',
    ),
    'league/oauth1-client' => 
    array (
      'pretty_version' => 'v1.9.0',
      'version' => '1.9.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '1e7e6be2dc543bf466236fb171e5b20e1b06aee6',
    ),
    'mockery/mockery' => 
    array (
      'pretty_version' => '0.9.11',
      'version' => '0.9.11.0',
      'aliases' => 
      array (
      ),
      'reference' => 'be9bf28d8e57d67883cba9fcadfcff8caab667f8',
    ),
    'monolog/monolog' => 
    array (
      'pretty_version' => '1.26.0',
      'version' => '1.26.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '2209ddd84e7ef1256b7af205d0717fb62cfc9c33',
    ),
    'mtdowling/cron-expression' => 
    array (
      'pretty_version' => 'v1.2.3',
      'version' => '1.2.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '9be552eebcc1ceec9776378f7dcc085246cacca6',
    ),
    'nesbot/carbon' => 
    array (
      'pretty_version' => '1.39.1',
      'version' => '1.39.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '4be0c005164249208ce1b5ca633cd57bdd42ff33',
    ),
    'nikic/php-parser' => 
    array (
      'pretty_version' => 'v2.1.1',
      'version' => '2.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '4dd659edadffdc2143e4753df655d866dbfeedf0',
    ),
    'paragonie/random_compat' => 
    array (
      'pretty_version' => 'v1.4.3',
      'version' => '1.4.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '9b3899e3c3ddde89016f576edb8c489708ad64cd',
    ),
    'phpdocumentor/reflection-common' => 
    array (
      'pretty_version' => '2.2.0',
      'version' => '2.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '1d01c49d4ed62f25aa84a747ad35d5a16924662b',
    ),
    'phpdocumentor/reflection-docblock' => 
    array (
      'pretty_version' => '5.2.2',
      'version' => '5.2.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '069a785b2141f5bcf49f3e353548dc1cce6df556',
    ),
    'phpdocumentor/type-resolver' => 
    array (
      'pretty_version' => '1.4.0',
      'version' => '1.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6a467b8989322d92aa1c8bf2bebcc6e5c2ba55c0',
    ),
    'phpspec/prophecy' => 
    array (
      'pretty_version' => 'v1.10.3',
      'version' => '1.10.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '451c3cd1418cf640de218914901e51b064abb093',
    ),
    'phpunit/php-code-coverage' => 
    array (
      'pretty_version' => '2.2.4',
      'version' => '2.2.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'eabf68b476ac7d0f73793aada060f1c1a9bf8979',
    ),
    'phpunit/php-file-iterator' => 
    array (
      'pretty_version' => '1.4.5',
      'version' => '1.4.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '730b01bc3e867237eaac355e06a36b85dd93a8b4',
    ),
    'phpunit/php-text-template' => 
    array (
      'pretty_version' => '1.2.1',
      'version' => '1.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
    ),
    'phpunit/php-timer' => 
    array (
      'pretty_version' => '1.0.9',
      'version' => '1.0.9.0',
      'aliases' => 
      array (
      ),
      'reference' => '3dcf38ca72b158baf0bc245e9184d3fdffa9c46f',
    ),
    'phpunit/php-token-stream' => 
    array (
      'pretty_version' => '1.4.12',
      'version' => '1.4.12.0',
      'aliases' => 
      array (
      ),
      'reference' => '1ce90ba27c42e4e44e6d8458241466380b51fa16',
    ),
    'phpunit/phpunit' => 
    array (
      'pretty_version' => '4.8.36',
      'version' => '4.8.36.0',
      'aliases' => 
      array (
      ),
      'reference' => '46023de9a91eec7dfb06cc56cb4e260017298517',
    ),
    'phpunit/phpunit-mock-objects' => 
    array (
      'pretty_version' => '2.3.8',
      'version' => '2.3.8.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ac8e7a3db35738d56ee9a76e78a4e03d97628983',
    ),
    'psr/http-message' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f6561bf28d520154e4b0ec72be95418abe6d9363',
    ),
    'psr/http-message-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/log' => 
    array (
      'pretty_version' => '1.1.3',
      'version' => '1.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '0f73288fd15629204f9d42b7055f72dacbe811fc',
    ),
    'psr/log-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0.0',
      ),
    ),
    'psy/psysh' => 
    array (
      'pretty_version' => 'v0.7.2',
      'version' => '0.7.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e64e10b20f8d229cac76399e1f3edddb57a0f280',
    ),
    'ralouphie/getallheaders' => 
    array (
      'pretty_version' => '3.0.3',
      'version' => '3.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '120b605dfeb996808c31b6477290a714d356e822',
    ),
    'roumen/sitemap' => 
    array (
      'pretty_version' => 'v2.6.5',
      'version' => '2.6.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '43747375a1dc19b11aa52442c99628a8d104c0f7',
    ),
    'sebastian/comparator' => 
    array (
      'pretty_version' => '1.2.4',
      'version' => '1.2.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '2b7424b55f5047b47ac6e5ccb20b2aea4011d9be',
    ),
    'sebastian/diff' => 
    array (
      'pretty_version' => '1.4.3',
      'version' => '1.4.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '7f066a26a962dbe58ddea9f72a4e82874a3975a4',
    ),
    'sebastian/environment' => 
    array (
      'pretty_version' => '1.3.8',
      'version' => '1.3.8.0',
      'aliases' => 
      array (
      ),
      'reference' => 'be2c607e43ce4c89ecd60e75c6a85c126e754aea',
    ),
    'sebastian/exporter' => 
    array (
      'pretty_version' => '1.2.2',
      'version' => '1.2.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '42c4c2eec485ee3e159ec9884f95b431287edde4',
    ),
    'sebastian/global-state' => 
    array (
      'pretty_version' => '1.1.1',
      'version' => '1.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'bc37d50fea7d017d3d340f230811c9f1d7280af4',
    ),
    'sebastian/recursion-context' => 
    array (
      'pretty_version' => '1.0.5',
      'version' => '1.0.5.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b19cc3298482a335a95f3016d2f8a6950f0fbcd7',
    ),
    'sebastian/version' => 
    array (
      'pretty_version' => '1.0.6',
      'version' => '1.0.6.0',
      'aliases' => 
      array (
      ),
      'reference' => '58b3a85e7999757d6ad81c787a1fbf5ff6c628c6',
    ),
    'swiftmailer/swiftmailer' => 
    array (
      'pretty_version' => 'v5.4.12',
      'version' => '5.4.12.0',
      'aliases' => 
      array (
      ),
      'reference' => '181b89f18a90f8925ef805f950d47a7190e9b950',
    ),
    'symfony/console' => 
    array (
      'pretty_version' => 'v3.0.9',
      'version' => '3.0.9.0',
      'aliases' => 
      array (
      ),
      'reference' => '926061e74229e935d3c5b4e9ba87237316c6693f',
    ),
    'symfony/css-selector' => 
    array (
      'pretty_version' => 'v3.0.9',
      'version' => '3.0.9.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b8999c1f33c224b2b66b38253f5e3a838d0d0115',
    ),
    'symfony/debug' => 
    array (
      'pretty_version' => 'v3.0.9',
      'version' => '3.0.9.0',
      'aliases' => 
      array (
      ),
      'reference' => '697c527acd9ea1b2d3efac34d9806bf255278b0a',
    ),
    'symfony/dom-crawler' => 
    array (
      'pretty_version' => 'v3.0.9',
      'version' => '3.0.9.0',
      'aliases' => 
      array (
      ),
      'reference' => 'dff8fecf1f56990d88058e3a1885c2a5f1b8e970',
    ),
    'symfony/event-dispatcher' => 
    array (
      'pretty_version' => 'v3.4.47',
      'version' => '3.4.47.0',
      'aliases' => 
      array (
      ),
      'reference' => '31fde73757b6bad247c54597beef974919ec6860',
    ),
    'symfony/finder' => 
    array (
      'pretty_version' => 'v3.0.9',
      'version' => '3.0.9.0',
      'aliases' => 
      array (
      ),
      'reference' => '3eb4e64c6145ef8b92adefb618a74ebdde9e3fe9',
    ),
    'symfony/http-foundation' => 
    array (
      'pretty_version' => 'v3.0.9',
      'version' => '3.0.9.0',
      'aliases' => 
      array (
      ),
      'reference' => '49ba00f8ede742169cb6b70abe33243f4d673f82',
    ),
    'symfony/http-kernel' => 
    array (
      'pretty_version' => 'v3.0.9',
      'version' => '3.0.9.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd97ba4425e36e79c794e7d14ff36f00f081b37b3',
    ),
    'symfony/polyfill-ctype' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c6c942b1ac76c82448322025e084cadc56048b4e',
    ),
    'symfony/polyfill-intl-idn' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '2d63434d922daf7da8dd863e7907e67ee3031483',
    ),
    'symfony/polyfill-intl-normalizer' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '43a0283138253ed1d48d352ab6d0bdb3f809f248',
    ),
    'symfony/polyfill-mbstring' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '5232de97ee3b75b0360528dae24e73db49566ab1',
    ),
    'symfony/polyfill-php56' => 
    array (
      'pretty_version' => 'v1.20.0',
      'version' => '1.20.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '54b8cd7e6c1643d78d011f3be89f3ef1f9f4c675',
    ),
    'symfony/polyfill-php72' => 
    array (
      'pretty_version' => 'v1.22.1',
      'version' => '1.22.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cc6e6f9b39fe8075b3dabfbaf5b5f645ae1340c9',
    ),
    'symfony/process' => 
    array (
      'pretty_version' => 'v3.0.9',
      'version' => '3.0.9.0',
      'aliases' => 
      array (
      ),
      'reference' => '768debc5996f599c4372b322d9061dba2a4bf505',
    ),
    'symfony/routing' => 
    array (
      'pretty_version' => 'v3.0.9',
      'version' => '3.0.9.0',
      'aliases' => 
      array (
      ),
      'reference' => '9038984bd9c05ab07280121e9e10f61a7231457b',
    ),
    'symfony/translation' => 
    array (
      'pretty_version' => 'v3.0.9',
      'version' => '3.0.9.0',
      'aliases' => 
      array (
      ),
      'reference' => 'eee6c664853fd0576f21ae25725cfffeafe83f26',
    ),
    'symfony/var-dumper' => 
    array (
      'pretty_version' => 'v3.0.9',
      'version' => '3.0.9.0',
      'aliases' => 
      array (
      ),
      'reference' => '1f7e071aafc6676fcb6e3f0497f87c2397247377',
    ),
    'symfony/yaml' => 
    array (
      'pretty_version' => 'v3.3.18',
      'version' => '3.3.18.0',
      'aliases' => 
      array (
      ),
      'reference' => 'af615970e265543a26ee712c958404eb9b7ac93d',
    ),
    'tightenco/collect' => 
    array (
      'replaced' => 
      array (
        0 => 'v5.2.45',
      ),
    ),
    'vlucas/phpdotenv' => 
    array (
      'pretty_version' => 'v2.6.7',
      'version' => '2.6.7.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b786088918a884258c9e3e27405c6a4cf2ee246e',
    ),
    'webmozart/assert' => 
    array (
      'pretty_version' => '1.10.0',
      'version' => '1.10.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6964c76c7804814a842473e0c8fd15bab0f18e25',
    ),
  ),
);
private static $canGetVendors;
private static $installedByVendor = array();







public static function getInstalledPackages()
{
$packages = array();
foreach (self::getInstalled() as $installed) {
$packages[] = array_keys($installed['versions']);
}


if (1 === \count($packages)) {
return $packages[0];
}

return array_keys(array_flip(\call_user_func_array('array_merge', $packages)));
}









public static function isInstalled($packageName)
{
foreach (self::getInstalled() as $installed) {
if (isset($installed['versions'][$packageName])) {
return true;
}
}

return false;
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

$ranges = array();
if (isset($installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = $installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['version'])) {
return null;
}

return $installed['versions'][$packageName]['version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getPrettyVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return $installed['versions'][$packageName]['pretty_version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getReference($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['reference'])) {
return null;
}

return $installed['versions'][$packageName]['reference'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getRootPackage()
{
$installed = self::getInstalled();

return $installed[0]['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
self::$installedByVendor = array();
}




private static function getInstalled()
{
if (null === self::$canGetVendors) {
self::$canGetVendors = method_exists('Composer\Autoload\ClassLoader', 'getRegisteredLoaders');
}

$installed = array();

if (self::$canGetVendors) {
foreach (ClassLoader::getRegisteredLoaders() as $vendorDir => $loader) {
if (isset(self::$installedByVendor[$vendorDir])) {
$installed[] = self::$installedByVendor[$vendorDir];
} elseif (is_file($vendorDir.'/composer/installed.php')) {
$installed[] = self::$installedByVendor[$vendorDir] = require $vendorDir.'/composer/installed.php';
}
}
}

$installed[] = self::$installed;

return $installed;
}
}
