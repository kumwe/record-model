# Kumwe Record Model

[![Packagist version][version-badge]][package]
[![CI][ci-badge]][ci]
[![PHP requirement][php-badge]](composer.json)
[![License][license-badge]](LICENSE)

Immutable records, revisions, replay outcomes and scope values under `Kumwe\Record\Model`.

## Installation

Requires 64-bit PHP 8.5 with JSON and mbstring. Pin an exact pre-1.0 release:

```sh
composer require kumwe/record-model:0.1.3
```

Composer declares exact Access Context, Business Definition and Record Values requirements.
The version badge links published packages; CI reports default-branch package checks.
Core integration and independent release verification remain consumer responsibilities.

## Usage and Core contract

```php
require 'vendor/autoload.php';

\Kumwe\Record\Model\BusinessRecordRequestGuard::definition('acme.invoice');
$window = new \Kumwe\Record\Model\BusinessRecordReplayWindow();
```

Construct values directly. Nested record/revision fields are detached from caller
references; actor and field bounds are validated, and optimistic version overflow
uses the documented exception family. Core owns persistence, transactions, authorization,
trusted clocks, replay storage, concurrency and delivery. A replay window value does
not implement replay storage or claim processing.

See [public API](docs/public-api.md), [architecture](docs/architecture.md),
[integration](docs/integration.md), [dependency contract](docs/dependency-decisions.md),
[test ownership](docs/test-ownership.md), [release record](docs/release-record.md) and
[standalone consumer](examples/consumer.php).

## Development

Requires Node.js 20+ for development schema validation:

```sh
npm ci --prefix tools/schema-validator --ignore-scripts
composer install
composer check
```

Complete Ajv2020/YAML schema and rejection checks run alongside PHP behavior,
conformance, architecture, static analysis, manifests/governance, audit, dependency
identity, release automation and a no-dev authoritative archive consumer. CI runs
PHP 8.5 on Linux. Schema tooling remains excluded from consumer archives.

Published tags remain fixed. See [releasing](docs/releasing.md) and [changelog](CHANGELOG.md).
Licensed under [Apache-2.0](LICENSE).

[version-badge]: https://img.shields.io/packagist/v/kumwe/record-model
[package]: https://packagist.org/packages/kumwe/record-model
[ci-badge]: https://img.shields.io/github/actions/workflow/status/kumwe/record-model/ci.yml?branch=main
[ci]: https://github.com/kumwe/record-model/actions/workflows/ci.yml
[php-badge]: https://img.shields.io/packagist/php-v/kumwe/record-model
[license-badge]: https://img.shields.io/packagist/l/kumwe/record-model
