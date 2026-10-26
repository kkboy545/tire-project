<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สแกนตรวจวิเคราะห์ความชำรุดยางรถยนต์ - Tire Safety AI</title>
    <!-- Bootstrap 5 CSS สำหรับจัดหน้าเว็บให้สวยงาม รองรับมือถือ (Mobile-First) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>AI สแกนตรวจความชำรุดยางรถยนต์</h4>
                    </div>
                    <div class="card-body">
                        <!-- ฟอร์มสำหรับอัปโหลดภาพยางรถยนต์ -->
                        <form action="process_scan.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="tireImage" class="form-label">อัปโหลดหรือถ่ายภาพยางรถยนต์</label>
                                <input class="form-control" type="file" id="tireImage" name="tireImage" accept="image/*" required>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-success w-100 py-2">🔍 เริ่มประมวลผลด้วย AI</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-3">
                    <a href="index.php" class="btn btn-secondary btn-sm">← กลับหน้าหลัก</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>