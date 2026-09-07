# Changelog

## 0.1.1 - 2026-09-07

- Ship consumer-readable v2 manifests and YAML handoff with package-local governance drift checks and refreshed App consumer inventory.

- Refuse optimistic version exhaustion before integer overflow, and bound revision actors and snapshot fields.

- Detach nested record and revision fields from caller references, validate revision actor and field bounds, and refuse optimistic version overflow through the documented exception family.
- Add package-owned regression tests and refresh extraction handoff, dependency and release documentation.
- Keep exact stable dependency requirements; grouped weekly update PRs re-run the package gate.

## 0.1.0 - 2026-09-07

- Use published Business Definition 0.1.0 and Record Values 0.1.0 with stable Composer resolution.

### Added

- Portable immutable records, revisions, replay outcomes and scope values.
- NRM-2026-032: package extraction enabling the Version 2 migration. Roadmap impact: enables; no completion claim.

Normal publication verifies exact stable dependency tag, source and dist identity.
Independent attestations remain optional separate verification evidence.
