# now php client

[![Build Status](https://img.shields.io/travis/joecohens/now-php-client/master.svg?style=flat-square)](https://travis-ci.org/joecohens/now-php-client)
[![StyleCI](https://styleci.io/repos/106905656/shield?branch=master)](https://styleci.io/repos/106905656)

A non official PHP +5.4 client for the [Now Instant Api](https://zeit.co/api)

## Usage

Install the package:

```
composer require joecohens/now-php-client
```

Require composer autoload:

```php
require __DIR__.'/../vendor/autoload.php';
```

Create an instance of the Now Client:

```php
$now = new Jeocohens\Now\Now(API_TOKEN, TEAM_ID);
```

Use any of the resource enpoints:

```php
$now->deployments()
````

## Reference

#### Deployments

```php
$now->deployments();
$now->deployment($id);
$now->createDeployment($body);
$now->deleteDeployment($id);
```

#### Files

```php
$now->files($id);
$now->file($id, $fileId);
```

#### Domains

```php
$now->domains();
$now->addDomain($name, $isExternalDNS = false);
$now->deleteDomain($name);
$now->domainRecords($domain);
$now->addDomainRecord($domain, array $recordData = []);
$now->deleteDomainRecord($domain, $recordId);
```

#### Certificates

```php
$now->certificates($cn);
$now->createCertificate($cn);
$now->renewCertificate($cn);
$now->replaceCertificate($cn, $cert, $key, $ca);
$now->deleteCertificate($cn);
```

#### Aliases

```php
$now->aliases($id = null);
$now->createAlias($id, $alias);
$now->deleteAlias($id);
```

#### Secrets

```php
$now->secrets();
$now->createSecret($name, $value);
$now->renameSecret($id, $name);
$now->deleteSecret($id);
```
