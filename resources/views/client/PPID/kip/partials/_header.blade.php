<div class="d-flex justify-content-between align-items-center flex-wrap">
    @php
        use App\Enum\KlasifikasiEnum;
    @endphp

    <ul class="nav nav-tabs me-3" id="kipTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link @activeKip(strtolower(KlasifikasiEnum::BERKALA->name))" id="berkala-tab"
                href="{{ route('ppid-kip', ['klasifikasi' => strtolower(KlasifikasiEnum::BERKALA->name)]) }}"
                type="button" role="tab">{{ strtoupper(KlasifikasiEnum::BERKALA->value) }}</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link @activeKip(strtolower(KlasifikasiEnum::SERTA_MERTA->name))" id="serta-tab"
                href="{{ route('ppid-kip', ['klasifikasi' => strtolower(KlasifikasiEnum::SERTA_MERTA->name)]) }}"
                type="button" role="tab">{{ strtoupper(KlasifikasiEnum::SERTA_MERTA->value) }}</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link @activeKip(strtolower(KlasifikasiEnum::SETIAP_SAAT->name))" id="setiap-tab"
                href="{{ route('ppid-kip', ['klasifikasi' => strtolower(KlasifikasiEnum::SETIAP_SAAT->name)]) }}"
                type="button" role="tab">{{ strtoupper(KlasifikasiEnum::SETIAP_SAAT->value) }}</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link @activeKip(strtolower(KlasifikasiEnum::DIKECUALIKAN->name))" id="dikecualikan-tab"
                href="{{ route('ppid-kip', ['klasifikasi' => strtolower(KlasifikasiEnum::DIKECUALIKAN->name)]) }}"
                type="button" role="tab">{{ strtoupper(KlasifikasiEnum::DIKECUALIKAN->value) }}</a>
        </li>
    </ul>
    <form action="{{ route('ppid-kip', ['klasifikasi' => request()->route('klasifikasi')]) }}"
        class="d-flex align-items-center" role="search" id="searchForm" style="position: relative; width: 300px;">
        <div class="input-group" style="width: 100%;">
            <input type="text" name="search" class="form-control" placeholder="Cari Data .."
                value="{{ old('search') ?? $query }}" id="searchInput" autocomplete="off"
                style="padding-right: 2.5rem;">

            <!-- Clear button di dalam input -->
            <button type="button" id="clearSearch"
                style="
                      position: absolute;
                      right: 10px;  /* Dekat kanan input */
                      top: 50%;
                      transform: translateY(-50%);
                      border: none;
                      background: transparent;
                      font-size: 1.3rem;
                      color: #aaa;
                      cursor: pointer;
                      display: none;
                      padding: 0;
                      line-height: 1;
                  ">&times;</button>
        </div>
    </form>
</div>
