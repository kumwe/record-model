# record-model

Portable immutable records, revisions, replay outcomes and scope values.

The package owns value invariants, canonical serialization and its behavior/boundary/conformance tests. The host owns authorization, trusted generation resolution, persistence, SQL, transactions, lifecycle, delivery and operational recovery. Native arithmetic belongs exclusively to Engine; this package contains no native fallback.

## Runtime dependency closure

Record Model requires the canonical `kumwe/record-values` package for shared value admission and storage normalization. The Version 2 catalog omits this existing source dependency. The extracted runtime uses this narrow edge instead of duplicating RecordValueGuard or weakening admission. Composer pins the published Record Values 0.1.0 release. Record Values remains the sole owner of portable value admission and storage normalization. The final release and its complete dependency closure must be independently verified before App adoption.
