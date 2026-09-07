# record-model

Portable immutable records, revisions, replay outcomes and scope values.

The package owns value invariants, canonical serialization and its behavior/boundary/conformance tests. The host owns authorization, trusted generation resolution, persistence, SQL, transactions, lifecycle, delivery and operational recovery. Native arithmetic belongs exclusively to Engine; this package contains no native fallback.

## Proposed dependency amendment

Record Model requires the canonical `kumwe/record-values` package for shared value admission and storage normalization. The Version 2 catalog omits this existing source dependency. The package proposes this narrow edge rather than duplicating RecordValueGuard or weakening record admission. Publication remains blocked until the catalog/charter amendment is reviewed and an immutable Record Values release is independently verified. The development constraint is a candidate integration input, never a release pin.
