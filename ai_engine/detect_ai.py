import sys
from ultralytics import YOLO

def detect_tire_damage(image_path):
    print(f"กำลังโหลดโมเดล YOLOv8 เพื่อตรวจสอบภาพ: {image_path}")
    
    # โหลดโมเดล YOLOv8 
    model = YOLO("yolov8n.pt") 
    
    # รันการตรวจจับวัตถุบนภาพยาง
    results = model(image_path)
    
    # แสดงผลลัพธ์คร่าวๆ ออกทางหน้าจอ Terminal
    for r in results:
        boxes = r.boxes
        print(f"พบวัตถุทั้งหมด: {len(boxes)} รายการ")
        for box in boxes:
            cls_id = int(box.cls[0])
            conf = float(box.conf[0])
            class_name = model.names[cls_id]
            print(f"- ตรวจพบ: {class_name} (ความมั่นใจ: {conf:.2f})")

if __name__ == "__main__":
    if len(sys.argv) > 1:
        img_path = sys.argv[1]
        detect_tire_damage(img_path)
    else:
        print("❌ กรุณาระบุ Path ของรูปภาพด้วยครับ")
