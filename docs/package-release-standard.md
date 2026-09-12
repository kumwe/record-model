# Package release standard

## Quality and release identity

PRs and default-branch release runs execute the same reusable CI workflow. The
**Package gate** requires source, behavior, boundary/conformance, complete schemas,
static analysis, API/governance, audit, dependency records, release fixtures and
clean no-dev archive-consumer checks. Failed or skipped required jobs block it.

Maintainers rebase reviewed PRs onto the current default branch. Release automation
reruns checks on the resulting commit and checks out its exact event SHA. A PR SHA
is not a promised future release identity. Recorded compatibility baselines and
external action/dependency pins keep their separate provenance purpose.

The newest stable changelog record selects the version and must match manifests.
An Unreleased-only changelog selects no release. Existing tags and releases remain
fixed; later source changes require a subsequent version to reach installed consumers.

## Publication and retries

Publication is serialized per branch. The helper verifies the tested commit and
creates or verifies its exact semantic tag and GitHub release in one workflow.
Lightweight and annotated tags resolve to commits. Existing published ancestor tags
may be verified; an unpublished tag can be completed only at the exact tested event
commit. Only a confirmed HTTP 404 authorizes creation. Authentication, rate-limit or
server failures never authorize replacement or mutation of existing releases.

After production Composer installation, the workflow runs
`tools/check-package-dependencies.sh` to verify published dependency versions against
exact tag, source and dist identities. Direct Kumwe requirements are exact stable
versions. Normal publication does not require external attestations or GitHub's
optional immutable-release setting. Existing repository rules and permissions apply.

Use the current default-branch workflow to retry publication after correcting its
reported failure. Confirm publication from actual release/tag/source metadata and
the successful default-branch run. A green PR alone does not establish publication.

## Independent consumer verification

Published packages and independently verified releases are separate evidence states.
The optional `tools/check-release-dependencies.sh` audit checks stricter platform
immutability, external attestation and released-commit workflow/clean-consumer evidence.
Preserve unresolved dependency evidence rather than inventing attestations.

Core adoption verifies the exact package source, archive, manifests and dependency
graph and then its composed integration. Source and package CI cannot establish Core
completion. The [release record](release-record.md) preserves this consumer contract.

## Repository hardening and maintenance

The [repository setup helper](repository-release-setup.md) is an explicit optional
administrator operation. `--check` audits; `--apply` changes managed settings. Ordinary
release runs do not invoke it or store administrator credentials. Keep existing
rules intact and report platform immutability only when observed.

Preserve shared release transition/setup/dependency fixtures when modifying automation.
Keep development tools excluded from archives and retain canonical manifests,
consumer documentation and the no-dev authoritative archive gate. Packagist follows
semantic tags after registration.
