# Releasing

Follow the [package release standard](package-release-standard.md). The newest
numbered changelog record selects the release; it must match public manifests.
PRs and default-branch rebase commits run the same complete package gate.

The publication workflow installs production dependencies and checks their exact
published tag, source and dist identities before publishing or verifying the recorded
release. Existing tags and releases remain fixed. An Unreleased-only changelog
publishes nothing; retries use the current default-branch workflow.

Independent artifact/dependency attestations and Core integration tests establish
consumer readiness separately. The strict evidence audit and optional administrator
hardening tools remain available; neither changes normal publication requirements.
