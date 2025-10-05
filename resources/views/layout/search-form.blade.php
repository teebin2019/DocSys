<!-- Toolbar -->
@isset($search_form)
    <section class="py-3">
        <div class="container">
            <form action="{{ route('search') }}" class="row g-2 align-items-center">
                <div class="col-12 col-md">
                    <label for="q" class="visually-hidden">ค้นหาเอกสาร</label>
                    <div class="input-group">
                        <span class="input-group-text bg-body">
                            <i class="bi bi-search"></i>
                        </span>
                        <input id="q" name="q" class="form-control" placeholder="ค้นหาเอกสาร ชื่อ/คำอธิบาย"
                            value="{{ $q ?? '' }}">
                    </div>
                </div>
                <div class="col-6 col-md-auto">
                    <select class="form-select" name="category">
                        <option value="">ทุกหมวดหมู่</option>
                        @foreach ($categories as $_category)
                            <option value="{{ $_category->id }}"{{ $category == $_category->id ? ' selected' : '' }}>
                                {{ $_category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-md-auto">
                    <select class="form-select" name="type">
                        <option value="">ทุกประเภท</option>
                        @foreach ($file_types as $item)
                            <option value="{{ $item }}"{{ $type == $item ? ' selected' : '' }}>{{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i> ค้นหา</button>
                </div>
            </form>
        </div>
    </section>
@endisset
