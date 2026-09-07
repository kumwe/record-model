# Dependency decision RM-001

Status: existing released source dependency, proposed catalogue reconciliation for maintainer review in PR #4.

The Version 2 catalogue names Access Context and Business Definition as Record Model's dependency ceiling.
The extracted `BusinessRecord`, `BusinessRecordRevision` and `RecordMutationResult` import
`Kumwe\Record\Value\RecordValueGuard` for portable admitted values and canonical storage representations.

Keep the explicit, exact stable `kumwe/record-values` dependency. Record Values owns this behavior. Removing the
edge would require duplicated value admission/canonicalization or an undeclared transitive runtime dependency.
Record Model gains no numeric arithmetic, conversion provider selection, cryptography, persistence or host authority.
Its internal array snapshot helper only detaches already admitted arrays; it does not normalize or convert them.

Record Values 0.1.0 remains the published coherent dependency. After its maintenance release is published and
independently verified, advance the pin and run record/revision/replay tests and the clean archive consumer.
Access Context has no conflicting transitive dependency and advances independently to its published 0.1.1.

The maintainer must reconcile the catalogue ceiling with this explicit source-derived edge before declaring full
catalogue alignment or starting App adoption. Publication of earlier packages does not itself approve that change.
