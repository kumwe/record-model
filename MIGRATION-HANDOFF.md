# Migration handoff

This candidate contains runtime implementation and package-owned tests. Publication and App adoption remain separate, attested tasks.

```yaml
{
  "schema": "kumwe-migration-handoff/v2",
  "artifact_kind": "framework_php",
  "migration_id": "KUMWE-MIG-2026-032",
  "change_set": "KUMWE-CS-2026-032",
  "state": "draft_pr_open",
  "source": {
    "app": {
      "repository": "https://github.com/kumwe/app",
      "baseline_commit": "24ecf956423c18933e824b43cea1bfb9127a79a9",
      "examined_paths": [
        "src/BusinessRecord/Domain/BusinessRecord.php",
        "src/BusinessRecord/Domain/BusinessRecordRevision.php",
        "src/BusinessRecord/Domain/RecordScope.php",
        "src/BusinessRecord/Domain/BusinessRecordReplayWindow.php",
        "src/BusinessRecord/Application/RecordMutationResult.php"
      ],
      "old_namespace_roots": [
        "Kumwe\\App\\BusinessRecord",
        "Kumwe\\App\\BusinessSchema",
        "Kumwe\\App\\BusinessReporting"
      ],
      "capability_index_sha256": null
    },
    "semantic_inputs": [
      {
        "owner": "kumwe/extension-sdk",
        "version_or_commit": "e8ec23f155c5836c6bd083f154a8efb6e50aec66",
        "manifest_or_corpus": "resources/extraction/v1.json",
        "sha256": "3b506944c93c06666e27931e25fad3a0eb9054a1f45d7a0b523711aaaf56f64e"
      }
    ],
    "examined_dependencies": [
      {
        "package": "kumwe/access-context",
        "constraint": "0.1.0",
        "independently_verified": false,
        "attestation": null
      },
      {
        "package": "kumwe/business-definition",
        "constraint": "dev-agent/candidate-sequence-dependency-v2",
        "independently_verified": false,
        "attestation": null
      },
      {
        "package": "kumwe/record-values",
        "constraint": "dev-agent/extraction-v2-business-data",
        "independently_verified": false,
        "attestation": null
      }
    ],
    "active_related_pull_requests": [
      "https://github.com/kumwe/record-values/pull/1",
      "https://github.com/kumwe/business-schema/pull/1",
      "https://github.com/kumwe/record-query/pull/1",
      "https://github.com/kumwe/reporting/pull/1"
    ]
  },
  "target": {
    "repository": "https://github.com/kumwe/record-model",
    "artifact_identity": "kumwe/record-model",
    "canonical_namespace_or_abi": "Kumwe\\Record\\Model\\",
    "branch": "agent/extraction-v2-business-data",
    "pull_request": "https://github.com/kumwe/record-model/pull/1"
  },
  "ownership": {
    "responsibility": "Portable immutable records, revisions, replay outcomes and scope values.",
    "non_responsibilities": [
      "authorization",
      "trusted generation selection",
      "persistence",
      "SQL execution",
      "transactions",
      "delivery",
      "native execution"
    ],
    "allowed_dependency_ceiling": [
      "php",
      "php-64bit",
      "ext-json",
      "kumwe/access-context",
      "kumwe/business-definition",
      "kumwe/record-values",
      "ramsey/uuid",
      "ext-mbstring"
    ],
    "implementation_owner": "kumwe/record-model",
    "next_consumer": "kumwe/app",
    "public_manifests": [
      {
        "path": "resources/public-api/v1.json",
        "sha256": "c21a57eda2428c7bb5a8cea9b1c633c1b2d5229b8fc3dfe3ea65abfd370bfb4b"
      },
      {
        "path": "resources/capabilities/v1.json",
        "sha256": "8f4aa7bffc769e57837241a90115a0b49c938776e22059591203bd970547e80e"
      },
      {
        "path": "resources/service-map/v1.json",
        "sha256": "fc6045d64b8d26181ec88f5f240403b08e083fc365cbcecc5510e6e53d9dcea3"
      },
      {
        "path": "resources/test-ownership/v1.json",
        "sha256": "a33c989b29319d82d1c7c597929db70e6681ba1f427a5f75c33b8b9667ae4321"
      }
    ],
    "intentionally_excluded": [
      "App repositories, policy gates and lifecycle orchestration",
      "production PHP native executor fallback"
    ]
  },
  "framework_php": {
    "composer_package": "kumwe/record-model",
    "canonical_namespace": "Kumwe\\Record\\Model\\",
    "public_api_manifest": "resources/public-api/v1.json",
    "capability_manifest": "resources/capabilities/v1.json",
    "service_map": "resources/service-map/v1.json",
    "extracted_symbols": [
      {
        "old_owner": "app",
        "source_path": "src/BusinessRecord/Domain/BusinessRecord.php",
        "target_path": "src/BusinessRecord.php"
      },
      {
        "old_owner": "app",
        "source_path": "src/BusinessRecord/Domain/BusinessRecordRevision.php",
        "target_path": "src/BusinessRecordRevision.php"
      },
      {
        "old_owner": "app",
        "source_path": "src/BusinessRecord/Domain/RecordScope.php",
        "target_path": "src/RecordScope.php"
      },
      {
        "old_owner": "app",
        "source_path": "src/BusinessRecord/Domain/BusinessRecordReplayWindow.php",
        "target_path": "src/BusinessRecordReplayWindow.php"
      },
      {
        "old_owner": "app",
        "source_path": "src/BusinessRecord/Application/RecordMutationResult.php",
        "target_path": "src/RecordMutationResult.php"
      },
      {
        "old_owner": "extension-sdk",
        "source_path": "src/Spi/BusinessRecord/Application/BusinessRecordRequestGuard.php",
        "target_path": "src/BusinessRecordRequestGuard.php"
      }
    ],
    "consumers": {
      "app_code": [
        "src/BusinessRecord/Domain/BusinessRecord.php",
        "src/BusinessRecord/Domain/BusinessRecordRevision.php",
        "src/BusinessRecord/Domain/RecordScope.php",
        "src/BusinessRecord/Domain/BusinessRecordReplayWindow.php",
        "src/BusinessRecord/Application/RecordMutationResult.php"
      ],
      "configuration_and_di": [],
      "reflection_and_string_references": [
        "Recompute using source/import closure at adoption head."
      ],
      "fixtures_and_examples": [],
      "external": [
        "kumwe/extension-sdk coordinated successor"
      ]
    },
    "dependency_injection": {
      "mode": "direct",
      "provider": null,
      "factories": [],
      "aliases": [],
      "service_lifetimes": [],
      "configuration_keys": [],
      "provider_absence_reason": "Values, contracts and stateless deterministic operations are constructed directly. Host ports are explicit inputs; no global context is captured."
    }
  },
  "native_cpp": null,
  "php_extension": null,
  "tests": {
    "moved_or_added": [
      {
        "path": "tests/BusinessRecordReplayWindowTest.php",
        "methods": [
          "testTheDefaultWindowRemembersAClaimLongerThanItReplaysIt",
          "testAClaimStillReplaysDaysAfterTheDayItUsedToExpireOn",
          "testTheDeclaredBoundsAreEnforced",
          "testConfigurationIsReadAsWholeSecondsOrRefused"
        ],
        "implementation_owner": "kumwe/record-model"
      },
      {
        "path": "tests/RecordBehaviorTest.php",
        "methods": [
          "testMutationPreservesOriginalAndIncrementsVersionOnce",
          "testRevisionChecksumPreservesProtectedStorageAndFieldSet",
          "testReplayRoundTripRetainsMutationPayload",
          "testMalformedRecordFieldCannotEnterSnapshot"
        ],
        "implementation_owner": "kumwe/record-model"
      },
      {
        "path": "tests/RecordScopeTest.php",
        "methods": [
          "testSiteOrganizationScopeRequiresAndBindsBothDimensions",
          "testInstallationAndSiteScopesRejectUnexpectedOrganizationInput"
        ],
        "implementation_owner": "kumwe/record-model"
      },
      {
        "path": "tests/RequestIdentityTest.php",
        "methods": [
          "testCanonicalRequestIdentityAndConcurrencyGrammar",
          "testUnboundedRecordIdentityIsRefused"
        ],
        "implementation_owner": "kumwe/record-model"
      }
    ],
    "remain_in_app_or_consumer": [
      "SQL/database matrix",
      "policy-before-query",
      "authorization and generation fences",
      "cryptographic envelope authenticity and key lifecycle",
      "transaction/concurrency and recovery",
      "export/delivery/adapters"
    ],
    "split_tests": [
      "BusinessRecordReplayWindowTest package owns window math; App keeps BusinessRecordIdempotencyConflict stable-code behavior."
    ],
    "prohibited_duplicates": [
      "Do not retain moved implementation tests in App/SDK after the separate verified adoption."
    ],
    "corpora": [
      "resources/conformance/document-validation-v1.json"
    ]
  },
  "documentation": {
    "charter": "CHARTER.md",
    "readme": "README.md",
    "public_api": "docs/public-api.md",
    "architecture": "docs/architecture.md",
    "integration_or_consumer": "docs/integration.md",
    "examples": [
      "examples/consumer.php"
    ],
    "changelog_record": "CHANGELOG.md / Unreleased"
  },
  "release_expectations": {
    "version_policy": "SemVer; determine release version after review. Replace development dependency constraints with exact independently verified pre-1.0 releases.",
    "expected_artifact_types": [
      "Composer source zip"
    ],
    "required_checks": [
      "composer check",
      "composer security:audit",
      "composer clean-consumer",
      "review dependency ceiling",
      "immutable release and source/artifact manifests independently attested"
    ],
    "required_registry_or_installer": "Composer",
    "required_external_attestation": true
  },
  "next_task": {
    "phase_name": "Independent release verification, followed by separate App adoption",
    "permitted_only_when": [
      "Human merges package PR",
      "Immutable upstream dependency releases and target release are independently verified",
      "External RELEASE-ATTESTATION.yaml exists and matches all source/artifact identities"
    ],
    "consumer_repository": "https://github.com/kumwe/app",
    "dependency_or_native_change": "Exact-pin the reviewed immutable package release and remove the former implementation. Never use this development branch as a released dependency.",
    "namespace_or_api_replacements": [
      {
        "old_owner": "app",
        "source_path": "src/BusinessRecord/Domain/BusinessRecord.php",
        "target_path": "src/BusinessRecord.php"
      },
      {
        "old_owner": "app",
        "source_path": "src/BusinessRecord/Domain/BusinessRecordRevision.php",
        "target_path": "src/BusinessRecordRevision.php"
      },
      {
        "old_owner": "app",
        "source_path": "src/BusinessRecord/Domain/RecordScope.php",
        "target_path": "src/RecordScope.php"
      },
      {
        "old_owner": "app",
        "source_path": "src/BusinessRecord/Domain/BusinessRecordReplayWindow.php",
        "target_path": "src/BusinessRecordReplayWindow.php"
      },
      {
        "old_owner": "app",
        "source_path": "src/BusinessRecord/Application/RecordMutationResult.php",
        "target_path": "src/RecordMutationResult.php"
      },
      {
        "old_owner": "extension-sdk",
        "source_path": "src/Spi/BusinessRecord/Application/BusinessRecordRequestGuard.php",
        "target_path": "src/BusinessRecordRequestGuard.php"
      }
    ],
    "files_to_update": [
      "composer.json",
      "composer.lock",
      "container configuration",
      "capability index",
      "migration ledger",
      "CHANGELOG.md"
    ],
    "files_to_remove": [
      "src/BusinessRecord/Domain/BusinessRecord.php",
      "src/BusinessRecord/Domain/BusinessRecordRevision.php",
      "src/BusinessRecord/Domain/RecordScope.php",
      "src/BusinessRecord/Domain/BusinessRecordReplayWindow.php",
      "src/BusinessRecord/Application/RecordMutationResult.php"
    ],
    "tests_to_remove": [
      "tests/BusinessRecordReplayWindowTest.php",
      "tests/RecordBehaviorTest.php",
      "tests/RecordScopeTest.php",
      "tests/RequestIdentityTest.php"
    ],
    "tests_to_retain_or_add": [
      "Host responsibility cases listed above",
      "Native parity against committed semantic corpus where applicable"
    ],
    "di_or_provisioning_changes": [],
    "capability_index_changes": [
      "Record actual release and package responsibility without declaring composed roadmap completion."
    ],
    "changelog_and_evidence_changes": [
      "Record immutable artifact, attestation and remaining host acceptance gates."
    ],
    "verification_commands": [
      "composer check",
      "composer clean-consumer",
      "App affected integration train and platform matrix"
    ]
  },
  "concurrency": {
    "likely_conflict_files": [
      "App composer.json",
      "App composer.lock",
      "App capability and migration registries"
    ],
    "related_migrations": [
      "KUMWE-MIG-2026-029",
      "KUMWE-MIG-2026-030",
      "KUMWE-MIG-2026-031",
      "KUMWE-MIG-2026-033"
    ],
    "ownership_conflicts": [],
    "integration_train": "Framework 4 Business Data",
    "resolution_rule": "semantic-preservation"
  },
  "governance": {
    "roadmap_source_sha256": "a202155ef1a65f5ab293d4f8397ebf4ac430db7f1e877c776bbe7851e6fe18d8",
    "roadmap_refs": [],
    "non_roadmap_refs": [
      "NRM-2026-032"
    ],
    "completion_claim": false
  },
  "decisions": [
    "Canonical namespace and approved value behavior retained.",
    "No host authority or persistence moves into the package.",
    "See CHARTER.md for explicit dependency amendments; no release approval is inferred."
  ],
  "blockers": [
    "Immutable upstream releases and external attestations are not available for the entire dependency closure. No publication or App adoption is authorized by this candidate.",
    "Package candidate source checks do not substitute for clean immutable release verification.",
    "Review the explicit dependency-ceiling amendment in CHARTER.md before publication."
  ]
}
```
