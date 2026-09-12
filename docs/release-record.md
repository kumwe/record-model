---
schema: "kumwe-package-release-record/v1"
artifact_kind: "framework_php"
migration_id: "KUMWE-MIG-2026-032"
change_set: "KUMWE-CS-2026-032"
source:
  app:
    repository: "https://github.com/kumwe/app"
    baseline_commit: "24ecf956423c18933e824b43cea1bfb9127a79a9"
    examined_paths:
      - "docs/architecture/governance/core-growth-baseline.json"
      - "src/BusinessRecord/Application/BusinessRecordIdempotencyRepository.php"
      - "src/BusinessRecord/Application/BusinessRecordMutationPublication.php"
      - "src/BusinessRecord/Application/BusinessRecordReadRepository.php"
      - "src/BusinessRecord/Application/BusinessRecordRelationshipCoordinator.php"
      - "src/BusinessRecord/Application/BusinessRecordRevisionCursor.php"
      - "src/BusinessRecord/Application/BusinessRecordRevisionRepository.php"
      - "src/BusinessRecord/Application/BusinessRecordRevisionView.php"
      - "src/BusinessRecord/Application/BusinessRecordService.php"
      - "src/BusinessRecord/Application/BusinessRecordView.php"
      - "src/BusinessRecord/Application/BusinessRecordWriteRepository.php"
      - "src/BusinessRecord/Application/PostingPeriodLock.php"
      - "src/BusinessRecord/Application/RecordMutationResult.php"
      - "src/BusinessRecord/Application/RelationshipWriteResult.php"
      - "src/BusinessRecord/Domain/BusinessRecord.php"
      - "src/BusinessRecord/Domain/BusinessRecordReplayWindow.php"
      - "src/BusinessRecord/Domain/BusinessRecordRevision.php"
      - "src/BusinessRecord/Domain/RecordScope.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordIdempotencyRepository.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordQueryCompiler.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordReadRepository.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordRevisionRepository.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordWriteRepository.php"
      - "src/BusinessReporting/Infrastructure/BusinessRecordExportPolicySnapshotProvider.php"
      - "src/BusinessSecurity/Application/BusinessRecordAccessCatalogPlanner.php"
      - "src/BusinessSecurity/Application/BusinessRecordAccessController.php"
      - "src/BusinessSecurity/Application/BusinessRecordAccessOperationCatalogPlanner.php"
      - "src/BusinessSecurity/Infrastructure/Persistence/DoctrineBusinessRecordAccessController.php"
      - "src/BusinessSurface/Application/BusinessMutationPlanService.php"
      - "src/BusinessSurface/Application/BusinessOperationStatusRepository.php"
      - "src/BusinessSurface/Application/BusinessOperationStatusService.php"
      - "src/BusinessSurface/Application/BusinessRecordProjector.php"
      - "src/BusinessSurface/Application/BusinessSurfaceCatalog.php"
      - "src/BusinessSurface/Application/CustomBusinessActionExecutor.php"
      - "src/BusinessSurface/Infrastructure/Persistence/DoctrineBusinessOperationStatusRepository.php"
      - "src/Delivery/Http/Api/Business/BusinessRecordApiPresenter.php"
      - "src/Delivery/Http/Api/Business/BusinessRecordApiResponder.php"
      - "src/Kernel/Configuration/ApplicationConfiguration.php"
      - "src/Kernel/Configuration/ConfigurationFactory.php"
      - "tests/Architecture/ClientAssertedInstantBoundaryTest.php"
      - "tests/Integration/BusinessRecord/AggregateDocumentIntegrationTest.php"
      - "tests/Integration/BusinessRecord/BusinessRecordHistoryPagingIntegrationTest.php"
      - "tests/Integration/BusinessRecord/BusinessRecordPolicyCompilerIntegrationTest.php"
      - "tests/Integration/BusinessSurface/GeneratedBusinessQueryBudgetIntegrationTest.php"
      - "tests/Support/NeutralBusinessFixture.php"
      - "tests/Unit/Application/Automation/PurgeBusinessRecordIdempotencyHandlerTest.php"
      - "tests/Unit/BusinessRecord/Application/BusinessRecordMutationPublicationTest.php"
      - "tests/Unit/BusinessRecord/Application/BusinessRecordRelationshipCoordinatorTest.php"
      - "tests/Unit/BusinessRecord/Application/BusinessRecordRevisionCursorTest.php"
      - "tests/Unit/BusinessRecord/Application/BusinessRecordViewTest.php"
      - "tests/Unit/BusinessRecord/Application/PostingPeriodLockTest.php"
      - "tests/Unit/BusinessRecord/Domain/BusinessRecordReplayWindowTest.php"
      - "tests/Unit/BusinessRecord/Domain/RecordIntegrityTest.php"
      - "tests/Unit/BusinessRecord/Domain/RecordScopeTest.php"
      - "tests/Unit/BusinessSecurity/Application/BusinessRecordAccessPlanTest.php"
      - "tests/Unit/BusinessSecurity/Infrastructure/Persistence/DoctrineBusinessRecordAccessControllerTest.php"
      - "tests/Unit/BusinessSurface/Application/BusinessSurfaceCatalogTest.php"
      - "tests/Unit/BusinessSurface/Application/Custom/CustomBusinessActionExecutorTest.php"
      - "tests/Unit/Delivery/Console/Command/BusinessRecordConsolePresenterTest.php"
      - "tests/Unit/Delivery/Http/Api/Business/BusinessOperationStatusApiHandlerTest.php"
      - "tests/Unit/Delivery/Http/Api/Business/BusinessRecordApiPresenterTest.php"
      - "tests/Unit/Delivery/Http/Api/Business/BusinessRecordApiResponderTest.php"
    old_namespace_roots:
      - "Kumwe\\App\\BusinessRecord\\"
      - "Kumwe\\App\\BusinessSchema\\"
      - "Kumwe\\App\\BusinessReporting\\"
    capability_index_sha256: null
  semantic_inputs:
    -
      owner: "kumwe/extension-sdk"
      version_or_commit: "e8ec23f155c5836c6bd083f154a8efb6e50aec66"
      manifest_or_corpus: "resources/extraction/v1.json"
      sha256: "0cd7261673505264dba587203fab88e535a41c083376acd88068525b9fb49c66"
  examined_dependencies:
    - "kumwe/access-context 0.1.2; independent release attestation not asserted"
    - "kumwe/business-definition 0.1.2; independent release attestation not asserted"
    - "kumwe/record-values 0.1.4; independent release attestation not asserted"
target:
  repository: "https://github.com/kumwe/record-model"
  artifact_identity: "kumwe/record-model"
  canonical_namespace_or_abi: "Kumwe\\Record\\Model\\"
ownership:
  responsibility: "Portable immutable records, revisions, replay outcomes and scope values."
  non_responsibilities:
    - "authorization"
    - "trusted generation selection"
    - "persistence"
    - "SQL execution"
    - "transactions"
    - "delivery"
    - "native execution"
  allowed_dependency_ceiling:
    - "php"
    - "php-64bit"
    - "ext-json"
    - "kumwe/access-context"
    - "kumwe/business-definition"
    - "kumwe/record-values"
    - "ramsey/uuid"
    - "ext-mbstring"
  implementation_owner: "kumwe/record-model"
  next_consumer: "kumwe/app"
  public_manifests:
    -
      path: "resources/public-api/v1.json"
      sha256: "119608b245415e8f6af68d8faaf71c7fe4bdd19a9ac5821ae1d483f8d4bcd8c8"
    -
      path: "resources/capabilities/v1.json"
      sha256: "539e33fa84b18ded21cd7bf09dab9cbc35baab3f1b789d26eeebe9d1b9dc973b"
    -
      path: "resources/service-map/v1.json"
      sha256: "f18271ca0ea9271870f1081d9f7f29f6486289557dfe34a956fd12f9d8cc5458"
    -
      path: "resources/test-ownership/v1.json"
      sha256: "d9dab3bf976158c3ce6307f2e5ec130c5937c90c9da37faae2b6b0e810f0e5ed"
    -
      path: "resources/conformance/v1.json"
      sha256: "7e7baa8fdcda9c5b08619742b7ff52ef8f86a59a1c5afbf58a62241e83d9f07d"
  intentionally_excluded:
    - "App repositories, policy gates and lifecycle orchestration"
    - "production PHP native executor fallback"
framework_php:
  composer_package: "kumwe/record-model"
  canonical_namespace: "Kumwe\\Record\\Model\\"
  public_api_manifest: "resources/public-api/v1.json"
  capability_manifest: "resources/capabilities/v1.json"
  service_map: "resources/service-map/v1.json"
  extracted_symbols:
    -
      old_fqcn: "Kumwe\\App\\BusinessRecord\\Domain\\BusinessRecord"
      new_fqcn: "Kumwe\\Record\\Model\\BusinessRecord"
      source_path: "src/BusinessRecord/Domain/BusinessRecord.php"
      target_path: "src/BusinessRecord.php"
      kind: "class"
      public_methods:
        - "__construct"
        - "values"
        - "value"
        - "updated"
        - "transitioned"
        - "archived"
        - "restored"
        - "softDeleted"
      public_properties:
        - "definitionId"
        - "definitionVersion"
        - "recordKey"
        - "recordId"
        - "scope"
        - "version"
        - "workflowState"
        - "createdBy"
        - "createdAt"
        - "updatedBy"
        - "updatedAt"
        - "archivedBy"
        - "archivedAt"
        - "deletedBy"
        - "deletedAt"
      public_constants: []
      exceptions:
        - "InvalidArgumentException"
      serialization_contract: "See docs/public-api.md and package conformance corpus for exact serialization."
      compatibility: "Portable source closure; host authority stays with the consumer. See resources/extraction/v1.json for source ownership and extraction granularity."
    -
      old_fqcn: "Kumwe\\App\\BusinessRecord\\Domain\\BusinessRecordRevision"
      new_fqcn: "Kumwe\\Record\\Model\\BusinessRecordRevision"
      source_path: "src/BusinessRecord/Domain/BusinessRecordRevision.php"
      target_path: "src/BusinessRecordRevision.php"
      kind: "class"
      public_methods:
        - "__construct"
        - "snapshot"
        - "changedFields"
        - "checksum"
      public_properties:
        - "revisionId"
        - "definitionId"
        - "definitionVersion"
        - "siteIdentifier"
        - "organizationIdentifier"
        - "recordKey"
        - "recordIdentityDigest"
        - "recordVersion"
        - "revisionNumber"
        - "operation"
        - "actorId"
        - "occurredAt"
      public_constants: []
      exceptions:
        - "InvalidArgumentException"
      serialization_contract: "See docs/public-api.md and package conformance corpus for exact serialization."
      compatibility: "Portable source closure; host authority stays with the consumer. See resources/extraction/v1.json for source ownership and extraction granularity."
    -
      old_fqcn: "Kumwe\\App\\BusinessRecord\\Domain\\RecordScope"
      new_fqcn: "Kumwe\\Record\\Model\\RecordScope"
      source_path: "src/BusinessRecord/Domain/RecordScope.php"
      target_path: "src/RecordScope.php"
      kind: "class"
      public_methods:
        - "forDefinition"
        - "reconstitute"
        - "assertRequest"
        - "toArray"
      public_properties:
        - "mode"
        - "siteIdentifier"
        - "organizationIdentifier"
      public_constants: []
      exceptions:
        - "InvalidArgumentException"
      serialization_contract: "See docs/public-api.md and package conformance corpus for exact serialization."
      compatibility: "Portable source closure; host authority stays with the consumer. See resources/extraction/v1.json for source ownership and extraction granularity."
    -
      old_fqcn: "Kumwe\\App\\BusinessRecord\\Domain\\BusinessRecordReplayWindow"
      new_fqcn: "Kumwe\\Record\\Model\\BusinessRecordReplayWindow"
      source_path: "src/BusinessRecord/Domain/BusinessRecordReplayWindow.php"
      target_path: "src/BusinessRecordReplayWindow.php"
      kind: "class"
      public_methods:
        - "__construct"
        - "fromConfiguration"
        - "expiryFrom"
        - "admitsReplay"
      public_properties:
        - "replaySeconds"
        - "retentionSeconds"
      public_constants:
        - "MINIMUM_REPLAY_SECONDS"
        - "DEFAULT_REPLAY_SECONDS"
        - "MAXIMUM_REPLAY_SECONDS"
        - "DEFAULT_RETENTION_SECONDS"
        - "MAXIMUM_RETENTION_SECONDS"
      exceptions:
        - "InvalidArgumentException"
      serialization_contract: "See docs/public-api.md and package conformance corpus for exact serialization."
      compatibility: "Portable source closure; host authority stays with the consumer. See resources/extraction/v1.json for source ownership and extraction granularity."
    -
      old_fqcn: "Kumwe\\App\\BusinessRecord\\Application\\RecordMutationResult"
      new_fqcn: "Kumwe\\Record\\Model\\RecordMutationResult"
      source_path: "src/BusinessRecord/Application/RecordMutationResult.php"
      target_path: "src/RecordMutationResult.php"
      kind: "class"
      public_methods:
        - "__construct"
        - "asReplay"
        - "toArray"
        - "fromArray"
      public_properties:
        - "definitionId"
        - "definitionVersion"
        - "recordKey"
        - "recordId"
        - "version"
        - "workflowState"
        - "operation"
        - "deleted"
        - "replayed"
      public_constants: []
      exceptions:
        - "InvalidArgumentException"
      serialization_contract: "See docs/public-api.md and package conformance corpus for exact serialization."
      compatibility: "Portable source closure; host authority stays with the consumer. See resources/extraction/v1.json for source ownership and extraction granularity."
    -
      old_fqcn: "Kumwe\\Extension\\Spi\\BusinessRecord\\Application\\BusinessRecordRequestGuard"
      new_fqcn: "Kumwe\\Record\\Model\\BusinessRecordRequestGuard"
      source_path: "src/Spi/BusinessRecord/Application/BusinessRecordRequestGuard.php"
      target_path: "src/BusinessRecordRequestGuard.php"
      kind: "class"
      public_methods:
        - "definition"
        - "record"
        - "handle"
        - "organization"
        - "version"
        - "approval"
      public_properties: []
      public_constants: []
      exceptions: []
      serialization_contract: "See docs/public-api.md and package conformance corpus for exact serialization."
      compatibility: "Portable source closure; host authority stays with the consumer. See resources/extraction/v1.json for source ownership and extraction granularity."
  consumers:
    app_code:
      - "src/BusinessRecord/Application/BusinessRecordIdempotencyRepository.php"
      - "src/BusinessRecord/Application/BusinessRecordMutationPublication.php"
      - "src/BusinessRecord/Application/BusinessRecordReadRepository.php"
      - "src/BusinessRecord/Application/BusinessRecordRelationshipCoordinator.php"
      - "src/BusinessRecord/Application/BusinessRecordRevisionCursor.php"
      - "src/BusinessRecord/Application/BusinessRecordRevisionRepository.php"
      - "src/BusinessRecord/Application/BusinessRecordRevisionView.php"
      - "src/BusinessRecord/Application/BusinessRecordService.php"
      - "src/BusinessRecord/Application/BusinessRecordView.php"
      - "src/BusinessRecord/Application/BusinessRecordWriteRepository.php"
      - "src/BusinessRecord/Application/PostingPeriodLock.php"
      - "src/BusinessRecord/Application/RelationshipWriteResult.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordIdempotencyRepository.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordQueryCompiler.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordReadRepository.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordRevisionRepository.php"
      - "src/BusinessRecord/Infrastructure/Persistence/DoctrineBusinessRecordWriteRepository.php"
      - "src/BusinessReporting/Infrastructure/BusinessRecordExportPolicySnapshotProvider.php"
      - "src/BusinessSecurity/Application/BusinessRecordAccessCatalogPlanner.php"
      - "src/BusinessSecurity/Application/BusinessRecordAccessController.php"
      - "src/BusinessSecurity/Application/BusinessRecordAccessOperationCatalogPlanner.php"
      - "src/BusinessSecurity/Infrastructure/Persistence/DoctrineBusinessRecordAccessController.php"
      - "src/BusinessSurface/Application/BusinessMutationPlanService.php"
      - "src/BusinessSurface/Application/BusinessOperationStatusRepository.php"
      - "src/BusinessSurface/Application/BusinessOperationStatusService.php"
      - "src/BusinessSurface/Application/BusinessRecordProjector.php"
      - "src/BusinessSurface/Application/BusinessSurfaceCatalog.php"
      - "src/BusinessSurface/Application/CustomBusinessActionExecutor.php"
      - "src/BusinessSurface/Infrastructure/Persistence/DoctrineBusinessOperationStatusRepository.php"
      - "src/Delivery/Http/Api/Business/BusinessRecordApiPresenter.php"
      - "src/Delivery/Http/Api/Business/BusinessRecordApiResponder.php"
      - "src/Kernel/Configuration/ApplicationConfiguration.php"
      - "src/Kernel/Configuration/ConfigurationFactory.php"
    configuration_and_di:
      - "docs/architecture/governance/core-growth-baseline.json"
    reflection_and_string_references: []
    fixtures_and_examples:
      - "tests/Architecture/ClientAssertedInstantBoundaryTest.php"
      - "tests/Integration/BusinessRecord/AggregateDocumentIntegrationTest.php"
      - "tests/Integration/BusinessRecord/BusinessRecordHistoryPagingIntegrationTest.php"
      - "tests/Integration/BusinessRecord/BusinessRecordPolicyCompilerIntegrationTest.php"
      - "tests/Integration/BusinessSurface/GeneratedBusinessQueryBudgetIntegrationTest.php"
      - "tests/Support/NeutralBusinessFixture.php"
      - "tests/Unit/Application/Automation/PurgeBusinessRecordIdempotencyHandlerTest.php"
      - "tests/Unit/BusinessRecord/Application/BusinessRecordMutationPublicationTest.php"
      - "tests/Unit/BusinessRecord/Application/BusinessRecordRelationshipCoordinatorTest.php"
      - "tests/Unit/BusinessRecord/Application/BusinessRecordRevisionCursorTest.php"
      - "tests/Unit/BusinessRecord/Application/BusinessRecordViewTest.php"
      - "tests/Unit/BusinessRecord/Application/PostingPeriodLockTest.php"
      - "tests/Unit/BusinessRecord/Domain/BusinessRecordReplayWindowTest.php"
      - "tests/Unit/BusinessRecord/Domain/RecordIntegrityTest.php"
      - "tests/Unit/BusinessRecord/Domain/RecordScopeTest.php"
      - "tests/Unit/BusinessSecurity/Application/BusinessRecordAccessPlanTest.php"
      - "tests/Unit/BusinessSecurity/Infrastructure/Persistence/DoctrineBusinessRecordAccessControllerTest.php"
      - "tests/Unit/BusinessSurface/Application/BusinessSurfaceCatalogTest.php"
      - "tests/Unit/BusinessSurface/Application/Custom/CustomBusinessActionExecutorTest.php"
      - "tests/Unit/Delivery/Console/Command/BusinessRecordConsolePresenterTest.php"
      - "tests/Unit/Delivery/Http/Api/Business/BusinessOperationStatusApiHandlerTest.php"
      - "tests/Unit/Delivery/Http/Api/Business/BusinessRecordApiPresenterTest.php"
      - "tests/Unit/Delivery/Http/Api/Business/BusinessRecordApiResponderTest.php"
    external:
      - "kumwe/extension-sdk coordinated successor"
  dependency_injection:
    mode: "direct"
    provider: null
    factories: []
    aliases: []
    service_lifetimes: []
    configuration_keys: []
    provider_absence_reason: "Values, contracts and stateless deterministic operations are constructed directly. Host ports are explicit inputs; no global context is captured."
native_cpp: null
php_extension: null
tests:
  moved_or_added:
    - "tools/schema-validator/verify.cjs: complete canonical manifest and release-record schemas with 15 rejection fixtures"
    - "tests/BusinessRecordReplayWindowTest.php (testTheDefaultWindowRemembersAClaimLongerThanItReplaysIt, testAClaimStillReplaysDaysAfterTheDayItUsedToExpireOn, testTheDeclaredBoundsAreEnforced, testConfigurationIsReadAsWholeSecondsOrRefused); provenance: resources/test-ownership/v1.json"
    - "tests/DocumentConformanceTest.php (testFrozenDocumentPlansRetainCanonicalDefinitionsAndPreparationFlags); provenance: resources/test-ownership/v1.json"
    - "tests/RecordBehaviorTest.php (testMutationPreservesOriginalAndIncrementsVersionOnce, testRevisionChecksumPreservesProtectedStorageAndFieldSet, testReplayRoundTripRetainsMutationPayload, testMalformedRecordFieldCannotEnterSnapshot); provenance: resources/test-ownership/v1.json"
    - "tests/RecordScopeTest.php (testSiteOrganizationScopeRequiresAndBindsBothDimensions, testInstallationAndSiteScopesRejectUnexpectedOrganizationInput); provenance: resources/test-ownership/v1.json"
    - "tests/RequestIdentityTest.php (testCanonicalRequestIdentityAndConcurrencyGrammar, testUnboundedRecordIdentityIsRefused); provenance: resources/test-ownership/v1.json"
    - "tests/ValueImmutabilityTest.php (testRecordAndRevisionDetachNestedCallerReferences, testRevisionRejectsUnboundedFieldsAndMalformedActors, testVersionExhaustionIsARefusalWithoutMutatingTheRecord); provenance: resources/test-ownership/v1.json"
  remain_in_app_or_consumer:
    - "SQL/database matrix"
    - "policy-before-query"
    - "authorization and generation fences"
    - "cryptographic envelope authenticity and key lifecycle"
    - "transaction/concurrency and recovery"
    - "export/delivery/adapters"
  split_tests:
    - "BusinessRecordReplayWindowTest package owns window math; App keeps BusinessRecordIdempotencyConflict stable-code behavior."
  prohibited_duplicates:
    - "Do not retain moved implementation tests in App/SDK after the separate verified adoption."
  corpora:
    - "resources/conformance/document-validation-v1.json"
    - "resources/conformance/document-validator-extension-v1.json"
    - "resources/conformance/document-preparation-v1.json"
    - "resources/conformance/document-normalized-values-v1.json"
    - "resources/conformance/document-validator-edges-v1.json"
    - "resources/conformance/document-computed-normalization-v1.json"
    - "resources/conformance/unicode-normalization-oracle-v1.json"
    - "resources/conformance/document-profile-v1.json"
documentation:
  charter: "CHARTER.md"
  readme: "README.md"
  public_api: "docs/public-api.md"
  architecture: "docs/architecture.md"
  integration_or_consumer: "docs/integration.md"
  examples:
    - "examples/consumer.php"
  changelog_record: "CHANGELOG.md / 0.1.3"
release_expectations:
  version_policy: "SemVer maintenance release 0.1.3 after human merge. Direct Kumwe dependencies use coherent exact published stable versions. Independent final release verification precedes App adoption."
  expected_artifact_types:
    - "Composer source zip"
  required_checks:
    - "composer check"
    - "composer security:audit"
    - "composer clean-consumer"
    - "review dependency ceiling"
    - "immutable release and source/artifact manifests independently attested"
  required_registry_or_installer: "Composer"
  required_external_attestation: true
consumer_contract:
  permitted_only_when:
    - "Human merges package PR"
    - "Immutable upstream dependency releases and target release are independently verified"
    - "External RELEASE-ATTESTATION.yaml exists and matches all source/artifact identities"
  consumer_repository: "https://github.com/kumwe/app"
  dependency_or_native_change: "Exact-pin the reviewed immutable package release and remove the former implementation. Never use this development branch as a released dependency."
  namespace_or_api_replacements:
    - "{\"old_owner\":\"app\",\"source_path\":\"src/BusinessRecord/Domain/BusinessRecord.php\",\"target_path\":\"src/BusinessRecord.php\",\"extraction_kind\":\"whole_file\"}"
    - "{\"old_owner\":\"app\",\"source_path\":\"src/BusinessRecord/Domain/BusinessRecordRevision.php\",\"target_path\":\"src/BusinessRecordRevision.php\",\"extraction_kind\":\"whole_file\"}"
    - "{\"old_owner\":\"app\",\"source_path\":\"src/BusinessRecord/Domain/RecordScope.php\",\"target_path\":\"src/RecordScope.php\",\"extraction_kind\":\"whole_file\"}"
    - "{\"old_owner\":\"app\",\"source_path\":\"src/BusinessRecord/Domain/BusinessRecordReplayWindow.php\",\"target_path\":\"src/BusinessRecordReplayWindow.php\",\"extraction_kind\":\"whole_file\"}"
    - "{\"old_owner\":\"app\",\"source_path\":\"src/BusinessRecord/Application/RecordMutationResult.php\",\"target_path\":\"src/RecordMutationResult.php\",\"extraction_kind\":\"whole_file\"}"
    - "{\"old_owner\":\"extension-sdk\",\"source_path\":\"src/Spi/BusinessRecord/Application/BusinessRecordRequestGuard.php\",\"target_path\":\"src/BusinessRecordRequestGuard.php\",\"extraction_kind\":\"whole_file\"}"
  files_to_update:
    - "composer.json"
    - "composer.lock"
    - "container configuration"
    - "capability index"
    - "migration ledger"
    - "CHANGELOG.md"
  files_to_remove:
    - "src/BusinessRecord/Domain/BusinessRecord.php"
    - "src/BusinessRecord/Domain/BusinessRecordRevision.php"
    - "src/BusinessRecord/Domain/RecordScope.php"
    - "src/BusinessRecord/Domain/BusinessRecordReplayWindow.php"
    - "src/BusinessRecord/Application/RecordMutationResult.php"
    - "src/Spi/BusinessRecord/Application/BusinessRecordRequestGuard.php"
  tests_to_remove:
    - "{\"owner\":\"app\",\"baseline_commit\":\"24ecf956423c18933e824b43cea1bfb9127a79a9\",\"path\":\"tests/Unit/BusinessRecord/Domain/BusinessRecordReplayWindowTest.php\",\"methods\":[\"testTheDefaultWindowRemembersAClaimLongerThanItReplaysIt\",\"testAClaimStillReplaysDaysAfterTheDayItUsedToExpireOn\",\"testTheDeclaredBoundsAreEnforced\",\"testConfigurationIsReadAsWholeSecondsOrRefused\"],\"retained_methods\":[\"testALateRepeatIsRefusedUnderItsOwnStableCode\"],\"remove_whole_file\":false}"
    - "{\"owner\":\"app\",\"baseline_commit\":\"24ecf956423c18933e824b43cea1bfb9127a79a9\",\"path\":\"tests/Unit/BusinessRecord/Domain/RecordScopeTest.php\",\"methods\":[\"testSiteOrganizationScopeRequiresAndBindsBothDimensions\",\"testInstallationAndSiteScopesRejectUnexpectedOrganizationInput\"],\"retained_methods\":[],\"remove_whole_file\":true}"
  tests_to_retain_or_add:
    - "Host responsibility cases listed above"
    - "Native parity against committed semantic corpus where applicable"
  di_or_provisioning_changes: []
  capability_index_changes:
    - "Record actual release and package responsibility without declaring composed roadmap completion."
  changelog_and_evidence_changes:
    - "Record immutable artifact, attestation and remaining host acceptance gates."
  verification_commands:
    - "composer check"
    - "composer clean-consumer"
    - "App affected integration train and platform matrix"
governance:
  completion_claim: false
decisions:
  - "Canonical namespace and approved value behavior retained."
  - "No host authority or persistence moves into the package."
  - "See CHARTER.md for explicit dependency amendments; no release approval is inferred."
blockers:
  - "Independent verification of the final maintenance release and its complete dependency closure remains a separate task before App adoption."
---

# Record Model release record

This record binds source ownership, public manifests, consumer mappings, DI and test
responsibilities. Recorded baseline paths are compatibility evidence rather than
current status claims about another repository.

## Package contract

Record Model owns immutable records, revisions, replay outcomes and scope values.
Core owns persistence, transactions, authorization, authoritative clocks, lifecycle,
cryptographic trust and delivery. Values use direct construction without an empty provider.

## Public API and responsibility

See [public API](public-api.md), [architecture](architecture.md) and canonical manifests.
Nested record/revision fields are detached from caller references. Revision actors
and fields have bounded admission; optimistic version overflow uses the documented
exception family. Value construction never grants host authority.

## Dependencies and semantic inputs

Access Context owns portable identity context, Business Definition owns definition
semantics, and Record Values owns admitted values/canonical storage. Exact Composer
requirements and the [dependency contract](dependency-decisions.md) preserve this graph.
The frozen conformance corpus retains baseline normalized/authorized input results;
Engine owns execution and its independent parity checks.

## Consumer contract

Core supplies already authorized values and trusted definitions. Bind canonical
package types across consumers, preserving transaction and authorization behavior.
Reconcile source mappings with current imports, signatures, configuration, escaped
strings, fixtures and dynamically composed names before removing duplicate classes.

## Test ownership

Package tests verify immutable values, revisions, replay outcomes, scope bounds and
conformance. The [test ownership contract](test-ownership.md) and resource manifest
preserve exact portable test provenance. Core keeps real storage, authorization,
replay persistence, transactions, concurrency, recovery and delivery integration tests.

## Consumer verification

Independently verify exact package/dependency releases, source identities, archive
and manifest digests, then run Core integration suites. Pre-1.0 exact constraints
must resolve to a coherent dependency graph; publication alone is not qualification.

## Compatibility and drift

Reconcile baseline source and test maps before replacement. Preserve newer portable
behavior in its canonical package owner and host-specific behavior in Core. Public
signatures, value bytes, trust provenance and historical release evidence remain fixed.

## Validation

Install the pinned Node schema toolchain and run `composer check`. Complete schemas,
rejection fixtures, PHP behavior/static checks, governance, audit, dependency identity,
release tests and a no-dev authoritative archive consumer verify the tested source.
