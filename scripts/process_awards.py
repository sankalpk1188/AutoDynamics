"""Copy and crop award photos for cleaner gallery display."""
import os
import shutil

try:
    from PIL import Image
except ImportError:
    Image = None

SRC_BASE = r"C:\Users\ADMIN\AppData\Roaming\Cursor\User\workspaceStorage\5cf91341954be667d771d5ffafb5f455\images"
DEST_BASE = r"c:\xampp\htdocs\auto-dynamics(8april26)-new design\public\assets\images\awards"

FILES = {
    "ACMA New Product Design Development and Localisation Award 2025-04319b14-34aa-460a-b1af-9b5d26a0c6a8.png": "acma-new-product-design-2025.png",
    "Certificate of Achievement for Innovative in Sustainable Solution 2023-31b923c8-39b7-4eec-88ae-7e9a872210ae.png": "altair-enlighten-award-2023.png",
    "IAC Group 2025 Gratitude Certificate for Superior Supplies-e2998abb-4cd8-4070-b602-526cc8591969.png": "iac-appreciation-2025.png",
    "Dun & Bradstreet Start-up Trailblazer 2024-9d57c474-d4df-477d-bb01-9d2043623759.png": "dun-bradstreet-startup-trailblazers-2024.png",
    "Mototech 2025 Esteemed Speaker Participation Award-c967f53e-f053-4b26-af32-8d7c7ce06c33.png": "mototech-pune-2025-speaker.png",
    "Grupo Antolin 2022-23 Best Supplier Award-ac1c3b45-7d1c-4809-8792-6d4c8864aada.png": "grupo-antolin-best-supplier-2022-23.png",
    "India's 5000 Best MSME Award 2024-8e98a648-d0b5-4775-8d47-06006e2b4d32.png": "india-5000-best-msme-2024.png",
    "ARAI International Conference on Material and Manufacturing 2023 Participaion Award-63d0093d-7b52-4eb3-a816-61265ceee2ca.png": "arai-materials-manufacturing-2023.png",
    "MSMECCI Most Innovative Exporter 2024-ccd1d1cc-11b0-40ee-8640-cf56add17d5e.png": "make-in-india-innovative-exporter-2024.png",
    "PCPA 2023 Innovative Company of the Year-1b4bdc3c-4820-4acb-8c99-5b78dde8dbde.png": "pcpa-innovative-company-2023.png",
    "ACMA 2025 16th Kaizen Competition-20697215-e2af-4f6e-9b9b-8966e8b2abb0.png": "acma-kaizen-competition-2025.png",
    "MCCI Certificate of Associateship 2025-26-e2b637a6-0732-41ab-a3a1-ef68a738a19f.png": "mccia-associateship-2025-26.png",
    "BOLE 2024 Royal Supporting Customer Award-b77d0f21-8314-4929-8e08-396701485f51.png": "bole-royal-supporting-customer-2024.png",
    "ACMA Excellence In Manufacturing 2025-14baa478-d968-4e22-ac01-90e2047ba9e8.png": "acma-excellence-manufacturing-2025.png",
}


def crop_center(img, ratio=0.74):
    w, h = img.size
    nw, nh = int(w * ratio), int(h * ratio)
    left = (w - nw) // 2
    top = (h - nh) // 2
    return img.crop((left, top, left + nw, top + nh))


def process_image(src, dest):
    if Image is None:
        shutil.copy2(src, dest)
        return "copied"

    img = Image.open(src).convert("RGB")
    img = crop_center(img, 0.74)
    max_side = 1200
    w, h = img.size
    if max(w, h) > max_side:
        scale = max_side / max(w, h)
        img = img.resize((int(w * scale), int(h * scale)), Image.Resampling.LANCZOS)
    img.save(dest, "PNG", optimize=True)
    return "processed"


def main():
    os.makedirs(DEST_BASE, exist_ok=True)
    for src_name, dest_name in FILES.items():
        src = os.path.join(SRC_BASE, src_name)
        dest = os.path.join(DEST_BASE, dest_name)
        if not os.path.exists(src):
            print(f"MISSING: {src_name}")
            continue
        mode = process_image(src, dest)
        print(f"{mode}: {dest_name}")


if __name__ == "__main__":
    main()
