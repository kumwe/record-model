# Public API

Constructor invariants, serialization, exceptions and method contracts follow. Values perform no I/O; host inputs must remain stable through each operation.

## Kumwe\Record\Model\BusinessRecordRevision

/**
 * One immutable entry in a business record's history, carrying the state the record was left in.
 *
 * `BusinessRecordService` appends a revision for every mutation of a definition that has revisions
 * enabled, and `DoctrineBusinessRecordRevisionRepository` re-derives `checksum()` when it reads a row
 * back and refuses one whose stored digest disagrees. That round trip is what forces the
 * canonicalisation done in the constructor: the snapshot is key-sorted and the changed-field list is
 * de-duplicated and sorted, so a revision hashes the same however the caller happened to order it,
 * and the record's own identity is kept as a digest so history stays queryable without storing the
 * business identity again in the clear.
 *
 * @since  2.0.0
 */

### __construct

/**
     * Assemble a revision, validating every part of it and canonicalising what the checksum covers.
     *
     * @param   string                $revisionId              UUID of this history entry.
     * @param   string                $definitionId            UUID of the entity type the record belongs to.
     * @param   int                   $definitionVersion       Definition version the record was written
     *          against; at least 1.
     * @param   string                $siteIdentifier          Site the record lives in.
     * @param   string|null           $organizationIdentifier  Organization branch within that site, or
     *          null when the record is site-wide.
     * @param   string                $recordKey               UUID of the record — its internal key, not
     *          its business identity.
     * @param   string                $recordIdentityDigest    Digest of the record's business identity,
     *          which is how history is found without storing that identity in the clear.
     * @param   int                   $recordVersion           Optimistic version of the record this entry
     *          captures; at least 1.
     * @param   int                   $revisionNumber          Position of this entry in the record's
     *          history; at least 1.
     * @param   string                $operation               Lowercase name of the mutation, such as
     *          `create`, `update` or `relate.<relationship>`.
     * @param   array<array-key, mixed>  $snapshot                Field values as at this revision, keyed by
     *          handle; each value must be one the record layer can carry.
     * @param   list<string>          $changedFields           Handles the mutation touched; order and
     *          duplicates are irrelevant, since the list is normalised here.
     * @param   string                $actorId                 Identity credited with the mutation.
     * @param   DateTimeImmutable     $occurredAt              Instant the mutation was applied.
     *
     * @throws  InvalidArgumentException  When an identifier is not a canonical UUID, the identity
     *          digest is not a 64-character hex digest, a version, operation, site or organization is
     *          malformed, or the snapshot holds an invalid handle or an unsupported value.
     *
     * @since   2.0.0
     */

### snapshot

/**
     * Return the field values the record held at this revision.
     *
     * @return  array<string, mixed>  Values keyed by field handle, sorted by handle; the same ordering
     *          the checksum was taken over.
     *
     * @since   2.0.0
     */

### changedFields

/**
     * Return the handles this mutation changed.
     *
     * @return  list<string>  Sorted, de-duplicated handles; empty when no field value moved, as an
     *          archive, restore or delete records.
     *
     * @since   2.0.0
     */

### checksum

/**
     * Derive the digest that proves this revision is the one that was written.
     *
     * The digest covers every part of the revision, including the snapshot and changed-field list in
     * their canonical order, so it is stable across processes and is what the repository compares a
     * stored row against before handing the revision on.
     *
     * @return  string  Lowercase 64-character SHA-256 digest of the revision's canonical JSON form.
     *
     * @throws  InvalidArgumentException  When the snapshot cannot be encoded as JSON and so cannot be
     *          checksummed.
     *
     * @since   2.0.0
     */

## Kumwe\Record\Model\RecordScope

/**
 * Resolved site and organization coordinates that one business record lives under.
 *
 * A business definition declares a `ScopeMode`; this is that mode applied to a concrete request or a
 * concrete stored row, and it is what the query compiler binds into the `site_identifier` and
 * `organization_identifier` predicates of every record statement and what the record itself carries.
 * The constructor is private, so an instance has come either through `forDefinition()` on the request
 * path, where site and organization are taken from the execution context rather than caller input, or through
 * `reconstitute()` on the read path. Both refuse any combination of identifiers the mode does not
 * describe, so a record can never be written, read, or compared outside the scope its definition
 * declares.
 *
 * @since  2.0.0
 */

### forDefinition

/**
     * Derive the scope a request runs under from the definition's mode and the caller's site.
     *
     * Both values must be supplied from the execution context by the application service, so a request
     * cannot establish either scope. The organization is trimmed and matched against a narrow identifier
     * pattern before it is accepted. The mode decides which dimensions are
     * mandatory: an organization is required exactly when the mode carries one, and rejected otherwise,
     * rather than being ignored.
     *
     * @param   ScopeMode    $mode                    Scope dimensions declared by the business definition.
     * @param   SiteContext  $site                    Site the operation is executing against.
     * @param   ?string      $organizationIdentifier  Authenticated organization, or null.
     *
     * @return  self  Scope carrying the context's site for site-bearing modes and null elsewhere.
     *
     * @throws  InvalidArgumentException  When the organization identifier is malformed, absent for a mode
     *          that requires one, or supplied for a mode that does not accept one.
     *
     * @since   2.0.0
     */

### reconstitute

/**
     * Rebuild the scope of a stored row from its persisted mode and scope columns.
     *
     * This is the read path's counterpart to `forDefinition()`: nothing is derived from the current
     * request and nothing is normalised, because the columns were written by an earlier one. What it
     * does check is that the stored pair still agrees with the mode of the definition version the row is
     * pinned to, so a row written under a different mode is refused rather than decoded into a record
     * claiming a scope it does not have.
     *
     * @param   ScopeMode  $mode                    Scope mode of the definition version the row pins.
     * @param   ?string    $siteIdentifier          `site_identifier` column as stored on the row.
     * @param   ?string    $organizationIdentifier  `organization_identifier` column as stored on the row.
     *
     * @return  self  Scope holding exactly the stored identifiers.
     *
     * @throws  InvalidArgumentException  When the stored identifiers do not match the dimensions the mode
     *          requires.
     *
     * @since   2.0.0
     */

### assertRequest

/**
     * Prove that a caller's own site and organization resolve to this exact scope.
     *
     * The requested pair is put through `forDefinition()` first, so it is validated against the mode the
     * same way the request path would validate it, and only then compared. Reach for this to stop a
     * record loaded under one scope from being acted on by a caller standing in another.
     *
     * @param   SiteContext  $site                    Site the current operation is executing against.
     * @param   ?string      $organizationIdentifier  Organization the current operation asked to work in.
     *
     * @return  void
     *
     * @throws  InvalidArgumentException  When the requested organization is malformed or disagrees with
     *          the mode, or when the resolved site or organization differs from this scope.
     *
     * @since   2.0.0
     */

### toArray

/**
     * Export the scope in the canonical shape two scopes are compared through.
     *
     * Equality of business-record scopes is decided on this array rather than on the object, and the same
     * array is folded into the browse cursor digest, so a cursor cannot be replayed against a different
     * site or organization.
     *
     * @return  array{mode: string, site: ?string, organization: ?string}  The mode's backing value beside
     *          the two identifiers, keyed `mode`, `site` and `organization`.
     *
     * @since   2.0.0
     */

## Kumwe\Record\Model\BusinessRecordReplayWindow

/**
 * How long a command's idempotency claim replays, and how long it is remembered after that.
 *
 * The caller mints the operation identifier, so the platform's half of the bargain is saying for how long
 * that identifier means something. Two horizons say it, and they are deliberately different:
 *
 * - **The replay horizon.** Inside it a repeat of the command hands back the outcome the first attempt
 *   recorded, so the command has exactly one effect however many times it is submitted.
 * - **The retention horizon.** Between the replay horizon and this one the claim is still in the ledger
 *   but no longer replays, so a late arrival is *refused by name* rather than silently becoming a second
 *   effect. Refusal is the whole point: a duplicate that is announced can be reconciled, and one that is
 *   not becomes a second document nobody knows about.
 *
 * A terminal that captured work offline and reconnects days later is the case this exists for. Decision
 * D14 does not build point of sale, but it does require that a long disconnection is a configuration
 * question rather than an architectural impossibility — so the window is declared, bounded and
 * configurable rather than a fixed day compiled into a mutation path.
 *
 * The retention horizon is the instant a claim becomes collectable, which is what the ledger stores as
 * the entry's expiry; the replay horizon is derived from the instant the claim was taken and is never
 * stored, so widening or narrowing the replay window changes how existing claims behave without
 * rewriting a single row.
 *
 * @since  2.0.0
 */

### __construct

/**
     * Declare the two horizons and prove they can hold together.
     *
     * @param   int  $replaySeconds     How long a completed claim hands its outcome back to a repeat.
     * @param   int  $retentionSeconds  How long the claim stays in the ledger refusing a late arrival;
     *          never shorter than the replay horizon, because a claim that stopped replaying has to
     *          survive long enough to say so.
     *
     * @throws  InvalidArgumentException  When either horizon falls outside its declared bounds, or when
     *          retention would end before replay does.
     *
     * @since   2.0.0
     */

### fromConfiguration

/**
     * Read the two horizons from operator configuration, falling back to the declared defaults.
     *
     * Configuration is text because it arrives from the environment, and a value that is absent, empty or
     * not a whole number of seconds is treated as unset rather than as zero — a misspelled setting must
     * not silently shorten a correctness window to nothing.
     *
     * @param   ?string  $replaySeconds     Configured replay horizon in seconds, or null when unset.
     * @param   ?string  $retentionSeconds  Configured retention horizon in seconds, or null when unset.
     *
     * @return  self  The declared window.
     *
     * @throws  InvalidArgumentException  When a configured value is present but outside its bounds.
     *
     * @since   2.0.0
     */

### expiryFrom

/**
     * Say when a claim taken now stops being remembered and becomes collectable.
     *
     * @param   DateTimeImmutable  $claimedAt  Instant the claim was taken, from the service's own clock.
     *
     * @return  DateTimeImmutable  The retention horizon, which the ledger stores as the entry's expiry.
     *
     * @since   2.0.0
     */

### admitsReplay

/**
     * Decide whether a repeat presented now is still inside the horizon that replays an outcome.
     *
     * @param   DateTimeImmutable  $claimedAt  Instant the original claim was taken.
     * @param   DateTimeImmutable  $now        Instant the repeat is being judged at.
     *
     * @return  bool  True while the outcome may be handed back; false once the repeat must be refused.
     *
     * @since   2.0.0
     */

## Kumwe\Record\Model\BusinessRecord

/**
 * One instance of a business definition, as the domain holds it between a read and a write.
 *
 * This is the currency of the whole BusinessRecord slice: repositories decode rows into it, the service
 * layer validates and hands it to policy, and every write returns a fresh instance rather than mutating
 * one. Two things make that safe. Construction re-checks the identity, version, workflow, actor and
 * lifecycle invariants on every instance, including the ones a repository builds from storage, so a row
 * that drifted cannot enter the domain. And each lifecycle transition is a named method that produces a
 * successor with `version` already incremented, which is the value the repository presents as the
 * optimistic lock, so no caller has to remember to bump it.
 *
 * The record knows the definition version it was written under and carries it forward unchanged. A
 * record read under an older shape stays on that shape until something migrates it, rather than being
 * silently reinterpreted against the newest definition.
 *
 * @since  2.0.0
 */

### __construct

/**
     * Assemble a record and prove every invariant it claims.
     *
     * Used both to create a record and to reconstitute a stored one, so the checks below run against
     * storage as well as against caller input.
     *
     * @param   string                $definitionId       UUID of the business definition this instance is
     *          an instance of.
     * @param   int                   $definitionVersion  Published definition version this instance was
     *          written under, which decoding must agree with.
     * @param   string                $recordKey          Internal storage key, a canonical UUID.
     * @param   string                $recordId           Caller-facing identity, unique within the scope.
     * @param   RecordScope           $scope              Installation, site or organization the record
     *          belongs to.
     * @param   int                   $version            Optimistic lock version; every successor carries
     *          this plus one.
     * @param   ?string               $workflowState      Current workflow state handle, or null when the
     *          definition declares no workflow.
     * @param   array<array-key, mixed>  $values             Field values keyed by handle; stored sorted by
     *          handle, capped at 256 entries.
     * @param   string                $createdBy          Actor identifier credited with creation.
     * @param   DateTimeImmutable     $createdAt          Instant the record was created.
     * @param   string                $updatedBy          Actor identifier credited with this version.
     * @param   DateTimeImmutable     $updatedAt          Instant this version was written.
     * @param   ?string               $archivedBy         Actor who archived the record; null unless
     *          archived, and paired with $archivedAt.
     * @param   ?DateTimeImmutable    $archivedAt         Instant the record was archived, or null when it
     *          is not archived.
     * @param   ?string               $deletedBy          Actor who soft-deleted the record; null unless
     *          deleted, and paired with $deletedAt.
     * @param   ?DateTimeImmutable    $deletedAt          Instant the record was soft-deleted, or null when
     *          it is live.
     *
     * @throws  InvalidArgumentException  When the definition id or storage key is not a UUID, the record
     *          id is empty, over 191 bytes or holds control characters, either version is below one, the
     *          workflow state is not a bounded lowercase handle, an actor identifier is malformed, an
     *          archive or delete actor and timestamp are not both set or both absent, there are more than
     *          256 fields, a field handle is invalid, or a value is of a type records cannot store.
     *
     * @since   2.0.0
     */

### values

/**
     * Expose the whole value set.
     *
     * @return  array<string, mixed>  Every stored field keyed by handle, in handle order; a field the
     *          record does not carry is simply absent rather than present as null.
     *
     * @since   2.0.0
     */

### value

/**
     * Read one field by handle.
     *
     * A stored null is a legitimate value and is returned as such, so absence is signalled by the
     * exception rather than by a null return.
     *
     * @param   string  $handle  Field handle to read.
     *
     * @return  mixed  The stored value, which may be a scalar, an array, or one of the domain value
     *          objects records may hold.
     *
     * @throws  InvalidArgumentException  When the record carries no field under that handle.
     *
     * @since   2.0.0
     */

### updated

/**
     * Produce the next version of this record carrying a new value set.
     *
     * The values given replace the whole set rather than merging into it, so a caller that means to change
     * one field passes the merged result. Workflow state and any archive marking are carried over
     * untouched; an archived record can still be edited this way.
     *
     * @param   array<array-key, mixed>  $values  Complete replacement value set, keyed by handle.
     * @param   string                $actor   Actor identifier to credit with the new version.
     * @param   DateTimeImmutable     $now     Instant to stamp on the new version.
     *
     * @return  self  A new record one version higher, with the same identity and scope.
     *
     * @throws  InvalidArgumentException  When the record is soft-deleted and must be restored first, when
     *          the replacement values fail the constructor's checks, or when $actor is not a valid actor
     *          identifier.
     *
     * @since   2.0.0
     */

### transitioned

/**
     * Produce the next version of this record sitting in a different workflow state.
     *
     * Values are carried over unchanged. Whether the move from the current state to $state is legal is a
     * policy question the workflow layer answers before calling; this only records the outcome.
     *
     * @param   string             $state  Handle of the workflow state to move into.
     * @param   string             $actor  Actor identifier to credit with the transition.
     * @param   DateTimeImmutable  $now    Instant to stamp on the new version.
     *
     * @return  self  A new record one version higher, in the requested state.
     *
     * @throws  InvalidArgumentException  When the record is soft-deleted and must be restored first, when
     *          $state is not a bounded lowercase handle, or when $actor is not a valid actor identifier.
     *
     * @since   2.0.0
     */

### archived

/**
     * Produce the next version of this record marked as archived.
     *
     * Archiving is a marking, not a removal: values, workflow state and identity survive, and `restored()`
     * reverses it. Archiving twice is refused so the original archive actor and instant are never
     * overwritten.
     *
     * @param   string             $actor  Actor identifier credited with archiving and with the new version.
     * @param   DateTimeImmutable  $now    Instant recorded as both the archive time and the update time.
     *
     * @return  self  A new record one version higher, carrying the archive marking.
     *
     * @throws  InvalidArgumentException  When the record is already archived, when it is soft-deleted and
     *          must be restored first, or when $actor is not a valid actor identifier.
     *
     * @since   2.0.0
     */

### restored

/**
     * Produce the next version of this record with both the archive and the delete marking cleared.
     *
     * This is the one transition a soft-deleted record accepts, which is why it builds its successor
     * directly instead of going through the shared copy path. It does not distinguish undeleting from
     * unarchiving: a record that was archived and then deleted comes back live, not archived.
     *
     * @param   string             $actor  Actor identifier to credit with the new version.
     * @param   DateTimeImmutable  $now    Instant to stamp on the new version.
     *
     * @return  self  A new record one version higher, live, with the same values and workflow state.
     *
     * @throws  InvalidArgumentException  When the record is neither archived nor soft-deleted, so there is
     *          nothing to restore, or when $actor is not a valid actor identifier.
     *
     * @since   2.0.0
     */

### softDeleted

/**
     * Produce the next version of this record marked as soft-deleted.
     *
     * The row keeps its values and its history so `restored()` can bring it back, but every other
     * transition refuses a deleted record from here on. Any existing archive marking is preserved, and
     * deleting twice is refused so the original delete actor and instant are never overwritten.
     *
     * @param   string             $actor  Actor identifier credited with the deletion and the new version.
     * @param   DateTimeImmutable  $now    Instant recorded as both the delete time and the update time.
     *
     * @return  self  A new record one version higher, carrying the delete marking.
     *
     * @throws  InvalidArgumentException  When the record is already soft-deleted, or when $actor is not a
     *          valid actor identifier.
     *
     * @since   2.0.0
     */

## Kumwe\Record\Model\RecordMutationResult

/**
 * Outcome of one business-record write, and the exact payload the idempotency ledger stores for it.
 *
 * A mutation has to be describable twice: once to the caller that performed it, and again to a caller
 * that repeats the same command under the same idempotency key and must be told what already happened
 * rather than having it happen again. This value object is both. `toArray()` is what the ledger persists
 * and checksums and `fromArray()` is how a replay rebuilds it, with `replayed` telling the two apart on
 * the way out. Every field is re-validated in the constructor, so a ledger row that was truncated or
 * tampered with fails to rebuild instead of being handed on as a plausible result.
 *
 * @since  2.0.0
 */

### __construct

/**
     * Capture the identity a completed mutation is reported and replayed under.
     *
     * @param   string   $definitionId       UUID of the business definition the record belongs to.
     * @param   int      $definitionVersion  Definition version the write was pinned to; at least 1.
     * @param   string   $recordKey          Internal UUID the row is stored under, which its revisions and
     *          relationships are keyed by.
     * @param   string   $recordId           Caller-facing identity of the record; at most 191 bytes and free
     *          of control characters.
     * @param   int      $version            Record version after this mutation, for the caller to send back
     *          as its expected version next time; at least 1.
     * @param   ?string  $workflowState      Workflow state the record now sits in, or null when its
     *          definition binds no workflow.
     * @param   string   $operation          What was performed, as the service names it — `create`,
     *          `update`, `archive`, `reorder` and the like.
     * @param   bool     $deleted            Whether the record no longer exists as a live row afterwards.
     * @param   bool     $replayed           Whether this describes a mutation replayed from the ledger
     *          rather than one applied by the call that returned it.
     *
     * @throws  InvalidArgumentException  When the definition id or record key is not a UUID, the record id
     *          is empty, over 191 bytes or carries a control character, either version is below 1, or the
     *          operation is not a lowercase name of at most 63 characters built from letters, digits, dots,
     *          dashes and underscores.
     *
     * @since   2.0.0
     */

### asReplay

/**
     * Copy this result with the replay flag raised, for a caller being told about an earlier mutation.
     *
     * @return  self  The same mutation metadata with `replayed` true; no other field changes.
     *
     * @since   2.0.0
     */

### toArray

/**
     * Export the mutation in the shape the idempotency ledger stores and checksums.
     *
     * @return  array<string, int|string|bool|null>  The identity and outcome fields under their snake_case
     *          column names. `replayed` is left out deliberately: it describes how a result reached a
     *          caller, not what the mutation did, so omitting it keeps the checksum equal for the original
     *          write and every replay of it.
     *
     * @since   2.0.0
     */

### fromArray

/**
     * Rebuild a stored result from a ledger row, already marked as a replay.
     *
     * Only the idempotency path reaches this, and it only reaches it about a mutation that has already
     * happened, so the rebuilt result always carries `replayed` true. Every entry is type checked before
     * the constructor sees it, which is what turns a row that lost a field or had one rewritten into a
     * refusal rather than a result the caller would act on.
     *
     * @param   array<string, mixed>  $data  Decoded ledger payload, in the shape `toArray()` writes.
     *
     * @return  self  The stored mutation, flagged as replayed.
     *
     * @throws  InvalidArgumentException  When an entry is absent or of the wrong type, or when the rebuilt
     *          values fail the constructor's identity and operation checks.
     *
     * @since   2.0.0
     */

## Kumwe\Record\Model\BusinessRecordRequestGuard

/** Exact identity and concurrency grammar shared by canonical business-record request DTOs. @since 0.2.0 */

### definition

/** @param string $value Definition identity to assert: a UUID or a multi-segment lowercase handle. @since 0.2.0 */

### record

/** @param string $value Record identity to assert: non-empty, at most 191 bytes, no control characters. @since 0.2.0 */

### handle

/**
     * @param  string  $value  Candidate handle: lowercase snake_case, at most 63 characters.
     * @param  string  $label  Role the handle plays (e.g. action, view, workflow state), named in the failure message.
     *
     * @since  0.2.0
     */

### organization

/** @param ?string $value Organization scope to assert, or null when the request carries no scope. @since 0.2.0 */

### version

/** @param int $value Expected optimistic-concurrency record version; must be one or greater. @since 0.2.0 */

### approval

/** @param ?string $value Approval-request identity to assert as a UUID, or null when none is attached. @since 0.2.0 */

