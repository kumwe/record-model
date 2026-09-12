# Dependency contract RM-001

Record Model depends directly on Access Context, Business Definition and Record Values.
`BusinessRecord`, `BusinessRecordRevision` and `RecordMutationResult` use
`Kumwe\Record\Value\RecordValueGuard` for admitted values and canonical storage.

Keep the explicit exact Record Values dependency. Removing it would require duplicated
admission/canonicalization or an undeclared transitive dependency. Record Model gains
no arithmetic, provider selection, cryptography, persistence or authority. Its internal
array snapshot helper detaches already admitted arrays without normalization.

The declared tuple is Access Context 0.1.2, Business Definition 0.1.2 and Record Values
0.1.4. Composer resolves their complete graph; record/revision/replay tests and the clean
archive consumer verify composition. Core's dependency catalogue must retain all three
edges. Independently verify exact source and artifact identities before adoption.
