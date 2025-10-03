<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <title>DocSys – เอกสารสำหรับดาวน์โหลด</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --card-radius: 14px;
        }

        .doc-card {
            border-radius: var(--card-radius);
        }

        .doc-icon {
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(13, 110, 253, .08);
        }

        .badge-type {
            text-transform: uppercase;
            letter-spacing: .02em;
        }

        .sticky-top-blur {
            position: sticky;
            top: 0;
            z-index: 1020;
            backdrop-filter: blur(6px);
            background-color: color-mix(in srgb, var(--bs-body-bg) 85%, transparent);
            border-bottom: 1px solid var(--bs-border-color);
        }

        @media (min-width: 992px) {
            .container-narrow {
                max-width: 920px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="sticky-top-blur">
        <div class="container container-narrow py-3">
            <div class="d-flex align-items-center gap-3">
                <div class="doc-icon"><i class="bi bi-folder2-open fs-5 text-primary"></i></div>
                <div>
                    <h1 class="h5 mb-0">DocSys – เอกสารสำหรับดาวน์โหลด</h1>
                    <small class="text-secondary">รายการเอกสารสาธารณะ/ภายในองค์กร</small>
                </div>
            </div>
        </div>
    </nav>

    <!-- Toolbar -->
    <section class="py-3">
        <div class="container container-narrow">
            <form class="row g-2 align-items-center">
                <div class="col-12 col-md">
                    <label for="q" class="visually-hidden">ค้นหาเอกสาร</label>
                    <div class="input-group">
                        <span class="input-group-text bg-body"><i class="bi bi-search"></i></span>
                        <input id="q" name="q" class="form-control"
                            placeholder="ค้นหาเอกสาร ชื่อ/คำอธิบาย/หมวดหมู่">
                    </div>
                </div>
                <div class="col-6 col-md-auto">
                    <select class="form-select" name="category">
                        <option value="">ทุกหมวดหมู่</option>
                        <option value="ann">ประกาศ / คำสั่ง / ข้อบังคับ</option>
                        <option value="tpl">ตัวอย่างหนังสือ / แบบฟอร์ม</option>
                        <option value="other">เอกสารอื่น ๆ</option>
                    </select>
                </div>
                <div class="col-6 col-md-auto">
                    <select class="form-select" name="type">
                        <option value="">ทุกประเภท</option>
                        <option value="pdf">PDF</option>
                        <option value="image">Image</option>
                        <option value="docx">Word</option>
                        <option value="xlsx">Excel</option>
                        <option value="pptx">PowerPoint</option>
                        <option value="txt">Text</option>
                        <option value="archive">Archive</option>
                    </select>
                </div>
                <div class="col-12 col-md-auto">
                    <button class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i> ค้นหา</button>
                </div>
            </form>
        </div>
    </section>

    <!-- List -->
    <main class="pb-5">
        <div class="container container-narrow">
            <!-- ตัวอย่างการ์ดเอกสาร 1 -->
            <div class="card doc-card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex gap-3">
                        <div class="doc-icon flex-shrink-0"><i class="bi bi-file-earmark-pdf text-primary"></i></div>
                        <div class="flex-grow-1">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <h2 class="h6 mb-0">ระเบียบการขออนุมัติเดินทางราชการ ปี 2568</h2>
                                <span class="badge text-bg-light border"><i class="bi bi-bookmark me-1"></i> ประกาศ /
                                    คำสั่ง</span>
                            </div>
                            <div class="mt-1 text-secondary small">
                                เอกสารแนวปฏิบัติและขั้นตอนการยื่นคำขอ เดินทางไปราชการ (ฉบับปรับปรุง)
                            </div>

                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <span class="badge rounded-pill border badge-type">PDF</span>
                                <span class="badge rounded-pill border">1.2 MB</span>
                                <span class="badge rounded-pill border"><i
                                        class="bi bi-unlock me-1"></i> Public</span>
                                <span class="text-muted small ms-auto">อัปเดต 3 ต.ค. 2568</span>
                            </div>

                            <div class="mt-3 d-flex flex-wrap gap-2">
                                <a class="btn btn-sm btn-outline-primary" href="#" target="_blank" rel="noopener">
                                    <i class="bi bi-box-arrow-up-right me-1"></i> เปิดดู
                                </a>
                                <a class="btn btn-sm btn-primary" href="#" download>
                                    <i class="bi bi-download me-1"></i> ดาวน์โหลด
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ตัวอย่างการ์ดเอกสาร 2 -->
            <div class="card doc-card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex gap-3">
                        <div class="doc-icon flex-shrink-0"><i class="bi bi-filetype-docx text-primary"></i></div>
                        <div class="flex-grow-1">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <h2 class="h6 mb-0">แบบฟอร์มคำร้องทั่วไป (ปรับปรุง)</h2>
                                <span class="badge text-bg-light border">
                                    <i class="bi bi-bookmark me-1"></i> ตัวอย่างหนังสือ / แบบฟอร์ม
                                </span>
                            </div>
                            <div class="mt-1 text-secondary small">
                                เอกสารตัวอย่างสำหรับกรอกคำร้องทั่วไป ใช้งานภายในหน่วยงาน
                            </div>

                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <span class="badge rounded-pill border badge-type">DOCX</span>
                                <span class="badge rounded-pill border">184 KB</span>
                                <span class="badge rounded-pill border">
                                    <i class="bi bi-shield-lock me-1"></i> Staff
                                </span>
                                <span class="text-muted small ms-auto">อัปเดต 1 ต.ค. 2568</span>
                            </div>

                            <div class="mt-3 d-flex flex-wrap gap-2">
                                <a class="btn btn-sm btn-outline-primary" href="#" target="_blank" rel="noopener">
                                    <i class="bi bi-box-arrow-up-right me-1"></i> เปิดดู
                                </a>
                                <a class="btn btn-sm btn-primary" href="#" download>
                                    <i class="bi bi-download me-1"></i> ดาวน์โหลด
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ตัวอย่างการ์ดเอกสาร 3 -->
            <div class="card doc-card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex gap-3">
                        <div class="doc-icon flex-shrink-0"><i class="bi bi-filetype-xlsx text-primary"></i></div>
                        <div class="flex-grow-1">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <h2 class="h6 mb-0">ตารางสรุปงบประมาณไตรมาส 4</h2>
                                <span class="badge text-bg-light border"><i class="bi bi-bookmark me-1"></i>
                                    เอกสารอื่น ๆ</span>
                            </div>
                            <div class="mt-1 text-secondary small">
                                ไฟล์สรุปงบประมาณประจำไตรมาส ใช้สำหรับการรายงานผู้บริหาร
                            </div>

                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <span class="badge rounded-pill text-bg-success-subtle border badge-type">XLSX</span>
                                <span class="badge rounded-pill text-bg-secondary-subtle border">612 KB</span>
                                <span class="badge rounded-pill text-bg-danger-subtle border"><i
                                        class="bi bi-shield-exclamation me-1"></i> Admin</span>
                                <span class="text-muted small ms-auto">อัปเดต 28 ก.ย. 2568</span>
                            </div>

                            <div class="mt-3 d-flex flex-wrap gap-2">
                                <a class="btn btn-sm btn-outline-primary disabled" tabindex="-1"
                                    aria-disabled="true">
                                    <i class="bi bi-box-arrow-up-right me-1"></i> เปิดดู
                                </a>
                                <a class="btn btn-sm btn-primary disabled" tabindex="-1" aria-disabled="true">
                                    <i class="bi bi-download me-1"></i> ดาวน์โหลด
                                </a>
                                <small class="text-muted ms-2 align-self-center">ต้องเข้าสู่ระบบด้วยสิทธิ์
                                    Admin</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination แบบง่าย (ตัวอย่าง) -->
            <nav class="d-flex justify-content-center mt-4" aria-label="pagination">
                <ul class="pagination pagination-sm">
                    <li class="page-item disabled"><span class="page-link">ก่อนหน้า</span></li>
                    <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">ถัดไป</a></li>
                </ul>
            </nav>

            <div class="text-center text-secondary small mt-3">
                © 2025 DocSys
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
