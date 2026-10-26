<?php
// ตรวจสอบว่ามีการส่งไฟล์ภาพมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['tireImage'])) {
    $file = $_FILES['tireImage'];
    
    // กำหนดโฟลเดอร์สำหรับเก็บภาพที่อัปโหลด
    $uploadDir = "uploads/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    // ตั้งชื่อไฟล์ใหม่เพื่อป้องกันชื่อซ้ำ
    $fileName = time() . "_" . basename($file['name']);
    $targetFilePath = $uploadDir . $fileName;
    
    // ย้ายไฟล์ไปยังโฟลเดอร์เป้าหมาย
    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        echo "<div style='font-family: sans-serif; max-width: 650px; margin: 30px auto; padding: 25px; border: 1px solid #ddd; border-radius: 12px; background: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.05);'>";
        echo "<h2 style='color: #28a745; margin-top: 0;'>✅ อัปโหลดภาพยางสำเร็จ!</h2>";
        echo "<p style='color: #666;'>กำลังส่งภาพไปยังระบบ AI (YOLOv8) เพื่อตรวจวิเคราะห์ความชำรุด...</p>";
        echo "<div style='text-align: center;'><img src='$targetFilePath' width='280' style='border-radius: 8px; border: 1px solid #eee; margin: 15px 0;'></div>";
        
        // --- ส่วนของการเรียกใช้งาน Python AI ---
        $absoluteImagePath = realpath($targetFilePath);
        $pythonScript = __DIR__ . "/ai_engine/detect_ai.py";
        
        // ใช้คำสั่ง python พร้อมดึงข้อผิดพลาด (stderr) ออกมาร่วมด้วย
        $command = "python " . escapeshellarg($pythonScript) . " " . escapeshellarg($absoluteImagePath) . " 2>&1";
        
        $output = [];
        $return_var = 0;
        exec($command, $output, $return_var);
        
        // แสดงผลลัพธ์จาก AI
        echo "<h3 style='color: #333; border-bottom: 2px solid #007bff; padding-bottom: 5px; margin-top: 20px;'>📊 ผลการตรวจวิเคราะห์จาก AI:</h3>";
        echo "<div style='background: #1e1e1e; color: #dcdcdc; padding: 15px; border-radius: 6px; font-family: monospace; font-size: 14px; white-space: pre-line; text-align: left; max-height: 250px; overflow-y: auto;'>";
        
        if (!empty($output)) {
            echo htmlspecialchars(implode("\n", $output));
        } else {
            echo "⚠️ ไม่พบข้อมูลผลลัพธ์จาก AI (Return Code: $return_var)";
        }
        echo "</div>";
        
        echo "<br><div style='text-align: center;'><a href='scanner.php' style='display: inline-block; padding: 12px 25px; background: #007bff; color: white; text-decoration: none; border-radius: 6px; font-weight: bold;'>🔄 สแกนภาพอื่นเพิ่ม</a></div>";
        echo "</div>";
        
    } else {
        echo "<h3 style='color: red;'>❌ เกิดข้อผิดพลาดในการอัปโหลดไฟล์</h3>";
        echo "<a href='scanner.php'>กลับไปลองใหม่อีกครั้ง</a>";
    }
} else {
    header("Location: scanner.php");
    exit();
}
?>