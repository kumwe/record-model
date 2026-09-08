# Dependency decision RM-001

Status: source-derived dependency amendment included in the integration-readiness review.

The Version 2 catalogue names Access Context and Business Definition as Record Model's dependency ceiling.
The extracted `BusinessRecord`, `BusinessRecordRevision` and `RecordMutationResult` import
`Kumwe\Record\Value\RecordValueGuard` for portable admitted values and canonical storage representations.

Keep the explicit, exact stable `kumwe/record-values` dependency. Record Values owns this behavior. Removing the
edge would require duplicated value admission/canonicalization or an undeclared transitive runtime dependency.
Record Model gains no numeric arithmetic, conversion provider selection, cryptography, persistence or host authority.
Its internal array snapshot helper only detaches already admitted arrays; it does not normalize or convert them.

Record Values 0.1.2 is published and requires Conversion 0.1.3. Business Definition 0.1.2 is published and
requires Localization 0.1.1 and Sequence 0.2.1. The 0.1.2 Record Model candidate selects these coherent
dependencies together with published Access Context 0.1.2, including its malformed-UTF-8 identity refusals.
Record/revision/replay tests and the clean archive consumer exercise this exact graph. Independent verification
of the final release and its dependency closure remains a separate downstream adoption requirement.

The package dependency ceiling is therefore Access Context, Business Definition and Record Values, with the
boundaries above. This source-derived reconciliation is part of the maintainer's review of this candidate.
The central catalogue must incorporate RM-001 during the later integration planning step; no App checkout
is changed here.
