Add-Type -ReferencedAssemblies System.Drawing -TypeDefinition @"
using System;
using System.Drawing;
using System.Drawing.Imaging;
using System.Runtime.InteropServices;

public class AdImgProcessor {
    public static void Process(string sourcePath, string inputPath, string outputPath, double wmFracX, double wmFracY, int hardCut, int softCut) {
        using (Bitmap src = new Bitmap(sourcePath)) {
            int w = src.Width, h = src.Height;
            Bitmap output = new Bitmap(w, h, PixelFormat.Format32bppArgb);
            using (Graphics g = Graphics.FromImage(output)) {
                g.DrawImage(src, 0, 0, w, h);
            }

            Rectangle rect = new Rectangle(0, 0, w, h);
            BitmapData data = output.LockBits(rect, ImageLockMode.ReadWrite, PixelFormat.Format32bppArgb);
            int stride = data.Stride;
            int bytes = stride * h;
            byte[] buf = new byte[bytes];
            Marshal.Copy(data.Scan0, buf, 0, bytes);

            int wmX = (int)(w * wmFracX);
            int wmY = (int)(h * wmFracY);
            double softRange = (double)(softCut - hardCut);
            if (softRange < 1) softRange = 1;

            for (int y = 0; y < h; y++) {
                int rowStart = y * stride;
                for (int x = 0; x < w; x++) {
                    int i = rowStart + x * 4;
                    byte b = buf[i];
                    byte gg = buf[i + 1];
                    byte r = buf[i + 2];

                    if (x >= wmX && y >= wmY) {
                        buf[i + 3] = 0;
                        continue;
                    }

                    int brightness = (r + gg + b) / 3;
                    if (brightness < hardCut) {
                        buf[i + 3] = 0;
                    } else if (brightness < softCut) {
                        int alpha = (int)((brightness - hardCut) / softRange * 255.0);
                        if (alpha < 0) alpha = 0;
                        if (alpha > 255) alpha = 255;
                        buf[i + 3] = (byte)alpha;
                    }
                }
            }

            Marshal.Copy(buf, 0, data.Scan0, bytes);
            output.UnlockBits(data);
            output.Save(outputPath, ImageFormat.Png);
            output.Dispose();
        }
    }
}
"@

$base = "c:\xampp\htdocs\auto-dynamics(8april26)-new design\public\assets\images\automotive"
$backup = Join-Path $base 'originals'
New-Item -ItemType Directory -Force -Path $backup | Out-Null

# Per-image tuned thresholds. hardCut = fully transparent below this brightness; softCut = ramps to fully opaque.
$jobs = @(
    @{ Name = "automotive-interior-hero.png";  Hard = 70; Soft = 110 },
    @{ Name = "automotive-exterior-hero.png";  Hard = 20; Soft = 55  },
    @{ Name = "automotive-underbody-hero.png"; Hard = 20; Soft = 55  }
)

foreach ($job in $jobs) {
    $f  = $job.Name
    $p  = Join-Path $base $f
    $bk = Join-Path $backup $f
    if (-not (Test-Path -LiteralPath $p)) { Write-Host "  MISSING: $p"; continue }

    # Keep an immutable original copy so we can always re-process from the pristine input.
    if (-not (Test-Path -LiteralPath $bk)) {
        Copy-Item -LiteralPath $p -Destination $bk -Force
    }

    Write-Host ("Processing {0} (hardCut={1}, softCut={2}) ..." -f $f, $job.Hard, $job.Soft)
    $tmp = "$p.tmp.png"
    [AdImgProcessor]::Process($bk, $p, $tmp, 0.92, 0.88, [int]$job.Hard, [int]$job.Soft)
    Move-Item -LiteralPath $tmp -Destination $p -Force
    Write-Host "  done"
}
