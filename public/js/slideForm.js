document.addEventListener("DOMContentLoaded", function () {
    let currentStep = 0;
    const steps = Array.from(document.querySelectorAll(".step"));
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const tombolLanjut = document.querySelector(".tombol-lanjut");
    const kirimData = document.getElementById("kirim-data");
    const boxes = Array.from(document.querySelectorAll(".box")); // progress bar kalau ada

    function showStep(index) {
        index = Math.max(0, Math.min(index, steps.length - 1));
        currentStep = index;

        // tampilkan step aktif
        steps.forEach((s, i) => {
            s.classList.toggle("active", i === index);
        });

        // tombol navigasi
        if (prevBtn)
            prevBtn.style.display = index === 0 ? "none" : "inline-block";
        if (nextBtn)
            nextBtn.style.display =
                index === steps.length - 1 ? "none" : "inline-block";
        if (tombolLanjut)
            tombolLanjut.style.display =
                index === steps.length - 1 ? "none" : "block";
        if (kirimData)
            kirimData.style.display =
                index === steps.length - 1 ? "block" : "none";

        // progress bar update
        boxes.forEach((b, i) => {
            b.classList.toggle("box-active", i <= index);
        });

        // 🔥 kalau step aktif = ringkasan, isi datanya
        if (steps[index].id === "ringkasan") {
            isiRingkasan();
        }
    }

    function validateDataDiri() {
        const requiredFields = document.querySelectorAll(
            "#dataDiri input[required], #dataDiri select[required], #dataDiri textarea[required]"
        );
        let valid = true;

        requiredFields.forEach((field) => {
            // skip kalau hidden
            if (field.offsetParent === null) return;

            if (!field.value.trim()) {
                field.classList.add("is-invalid");
                valid = false;
            } else {
                field.classList.remove("is-invalid");
            }

            // ✅ validasi khusus tanggal
            if (field.id === "tanggal-booking") {
                const today = new Date();
                today.setHours(0, 0, 0, 0); // reset jam biar bandingannya bersih
                const picked = new Date(field.value);

                if (picked < today) {
                    field.classList.add("is-invalid");
                    valid = false;
                }
            }
        });

        return valid;
    }

    function isiRingkasan() {
        let paketDipilih = [];
        let kategori = [
            "studiBanding",
            "batik",
            "kesenian",
            "cocokTanam",
            "permainan",
            "kuliner",
            "homestay",
        ];

        kategori.forEach((nama) => {
            let paket = document.querySelector(
                "input[name='" + nama + "']:checked"
            );
            if (paket) {
                let label = document.querySelector(
                    "label[for='" + paket.id + "']"
                );
                let namaPaket = label.querySelector("h5").innerText.trim();

                // ambil harga dari p terakhir
                let hargaElement = label.querySelector(
                    "p.card-text:last-of-type"
                );
                let harga = hargaElement
                    ? hargaElement.innerText.trim()
                    : "Rp 0";

                // skip kalau "Tidak Pesan"
                if (namaPaket !== "Tidak Pesan") {
                    paketDipilih.push({ nama: namaPaket, harga: harga });
                }
            }
        });

        // bikin table rows
        let rows =
            paketDipilih.length > 0
                ? paketDipilih
                      .map(
                          (p) =>
                              `<tr><td>${p.nama}</td><td class="text-end">${p.harga}</td></tr>`
                      )
                      .join("")
                : `<tr><td colspan="2"><i>Tidak ada paket dipilih</i></td></tr>`;

        // inject ke tabel
        document.getElementById(
            "summaryPaketList"
        ).innerHTML = `<table class="table table-sm table-bordered mb-0">
            <thead>
                <tr>
                    <th>Paket</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                ${rows}
            </tbody>
        </table>`;
    }

    // handler tombol
    window.changeStep = function (direction) {
        if (direction === 1 && currentStep === 0) {
            // validasi Data Diri (step pertama)
            if (!validateDataDiri()) {
                alert("Harap isi semua data diri terlebih dahulu!");
                return; // jangan lanjut kalau masih kosong
            }
        }
        showStep(currentStep + direction);
    };

    // handler klik progress bar (opsional)
    window.progress = function (index) {
        showStep(index);
    };

    // init pertama
    showStep(currentStep);
});
