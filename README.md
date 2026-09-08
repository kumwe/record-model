# record-model

Portable immutable records, revisions, replay outcomes and scope values.

Canonical namespace: `Kumwe\Record\Model`. Requires PHP 8.5, 64-bit. Version 0.1.0 has been published; this branch prepares the 0.1.1 maintenance release. App integration follows independent verification of the final release and its handoff.

Pure values and stateless normalization are constructed directly. No empty container provider is registered. Services with real collaborators receive explicit factories when introduced.

See [public API](docs/public-api.md), [architecture](docs/architecture.md), [integration](docs/integration.md) and [test ownership](docs/test-ownership.md).

For standalone verification, run `composer install` and `composer check`; see `docs/integration.md`. `composer clean-consumer` verifies the archive in a fresh no-dev classmap-authoritative consumer. License: Apache-2.0.

Maintenance release: Detach nested record and revision fields from caller references, validate revision actor and field bounds, and refuse optimistic version overflow through the documented exception family.

Direct Kumwe dependencies use exact stable versions. Dependabot proposes grouped weekly Composer updates; review and merge only after the complete package gate passes. The downstream App consumes a verified exact release, never an unreviewed moving `latest` constraint.

Source quality checks require Node.js 20+ and `npm ci --prefix tools/schema-validator --ignore-scripts`. The pinned Ajv2020/YAML gate validates all three canonical manifests and the complete handoff against authoritative schema snapshots, with rejection regressions. These development tools are excluded from consumer archives.
