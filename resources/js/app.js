// import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();
document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("mobile-menu-button");
    const menu = document.getElementById("mobile-menu");

    btn.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });
});
// Script Dashboard
if (typeof lucide !== "undefined") {
    lucide.createIcons();
}

const mobileMenuBtn = document.getElementById("mobileMenuBtn");
const sidebar = document.getElementById("sidebar");
const sidebarOverlay = document.getElementById("sidebarOverlay");

let isSidebarOpen = false;

function toggleSidebar() {
    if (!sidebar || !sidebarOverlay) return;

    isSidebarOpen = !isSidebarOpen;

    if (isSidebarOpen) {
        sidebar.classList.remove("-translate-x-full");
        sidebarOverlay.classList.remove("hidden");
        document.body.style.overflow = "hidden";
    } else {
        sidebar.classList.add("-translate-x-full");
        sidebarOverlay.classList.add("hidden");
        document.body.style.overflow = "";
    }
}

if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener("click", toggleSidebar);
}

if (sidebarOverlay) {
    sidebarOverlay.addEventListener("click", toggleSidebar);
}
const STORAGE_KEY = "LIBMATE_BOOKING_DATA";

let bookingData = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [
    {
        id: "BK-001",
        name: "Budi Santoso",
        room: "Lantai 2 - Ruang Tenang (A)",
        capacity: 4,
        date: "2026-04-20",
    },
    {
        id: "BK-002",
        name: "Siti Aminah",
        room: "Lantai 1 - Ruang Diskusi Terbuka",
        capacity: 8,
        date: "2026-04-19",
    },
];

const searchHistory = document.getElementById("search-history");
const form = document.getElementById("booking-form");
const tableBody = document.getElementById("table-body");
const emptyState = document.getElementById("empty-state");
const searchInput = document.getElementById("search-data");
const filterInput = document.getElementById("filter-data");
const btnCancelEdit = document.getElementById("btn-cancel-edit");
const formTitle = document.getElementById("form-title");

const inputs = {
    idBook: document.getElementById("input-book-id"),
    name: document.getElementById("input-name"),
    room: document.getElementById("input-room"),
    capacity: document.getElementById("input-capacity"),
    date: document.getElementById("input-date"),
    editId: document.getElementById("edit-id"),
};
if (searchHistory) {
    searchHistory.addEventListener("input", function () {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll("#history-table tbody tr");

        rows.forEach((row) => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(keyword) ? "" : "none";
        });
    });
}
// generate id
const generateNextId = () => {
    if (bookingData.length === 0) return "BK-001";

    const ids = bookingData.map((item) => {
        const numericPart = item.id.split("-")[1];
        return parseInt(numericPart);
    });

    const maxId = Math.max(...ids);
    const nextId = maxId + 1;

    return `BK-${nextId.toString().padStart(3, "0")}`;
};

const refreshAutoId = () => {
    if (!inputs.editId.value) {
        inputs.idBook.value = generateNextId();
    }
};

// form state
const resetFormState = () => {
    inputs.editId.value = "";
    inputs.idBook.disabled = false;
    inputs.idBook.classList.remove("bg-slate-100");
    formTitle.innerText = "Form Pemesanan Baru";
    document.getElementById("btn-submit").innerText = "Simpan Pesanan";
    btnCancelEdit.classList.add("hidden");
    form.reset();
    refreshAutoId();
};

const updateStats = () => {
    document.getElementById("stat-total-booking").innerText =
        bookingData.length;

    const today = new Date().toISOString().split("T")[0];
    const todayBookings = bookingData.filter((b) => b.date === today).length;
    document.getElementById("stat-today-booking").innerText = todayBookings;

    const totalPeople = bookingData.reduce(
        (sum, item) => sum + parseInt(item.capacity),
        0,
    );
    document.getElementById("stat-total-people").innerText = totalPeople;
};

const renderTable = () => {
    const searchTerm = searchInput.value.toLowerCase();
    const filterTerm = filterInput.value;

    const filteredData = bookingData.filter((item) => {
        const matchSearch =
            item.name.toLowerCase().includes(searchTerm) ||
            item.id.toLowerCase().includes(searchTerm);
        const matchFilter =
            filterTerm === "All" || item.room.includes(filterTerm);
        return matchSearch && matchFilter;
    });

    if (filteredData.length === 0) {
        tableBody.innerHTML = "";
        emptyState.classList.remove("hidden");
        emptyState.classList.add("flex");
    } else {
        emptyState.classList.add("hidden");
        emptyState.classList.remove("flex");

        tableBody.innerHTML = filteredData
            .map(
                (item) => `
          <tr class="hover:bg-orange-50 transition bg-white">
            <td class="px-4 py-3 font-semibold text-slate-800">${item.id}</td>
            <td class="px-4 py-3">
              <p class="font-medium text-slate-900">${item.name}</p>
              <p class="text-xs text-slate-500">${item.room}</p>
            </td>
            <td class="px-4 py-3">
              <span class="inline-block px-2 py-1 bg-slate-100 rounded text-xs font-medium text-slate-600 mb-1">📅 ${item.date}</span><br>
              <span class="text-xs text-slate-500">👥 ${item.capacity} Orang</span>
            </td>
            <td class="px-4 py-3 text-center">
              <div class="flex justify-center gap-2">
                <button type="button" class="btn-edit px-3 py-1.5 bg-blue-100 text-blue-600 rounded-md text-xs font-semibold hover:bg-blue-200 transition" data-id="${item.id}">Edit</button>
                <button type="button" class="btn-delete px-3 py-1.5 bg-red-100 text-red-600 rounded-md text-xs font-semibold hover:bg-red-200 transition" data-id="${item.id}">Batal</button>
              </div>
            </td>
          </tr>
        `,
            )
            .join("");
    }

    localStorage.setItem(STORAGE_KEY, JSON.stringify(bookingData));
    updateStats();
    refreshAutoId();
};

const validateForm = () => {
    let isValid = true;

    const checkField = (inputObj, errId, condition) => {
        const errNode = document.getElementById(errId);
        if (condition) {
            errNode.classList.remove("hidden");
            inputObj.classList.add("border-red-500");
            isValid = false;
        } else {
            errNode.classList.add("hidden");
            inputObj.classList.remove("border-red-500");
        }
    };

    checkField(inputs.name, "err-name", inputs.name.value.trim() === "");
    checkField(inputs.room, "err-room", inputs.room.value === "");
    checkField(
        inputs.capacity,
        "err-capacity",
        inputs.capacity.value === "" ||
            inputs.capacity.value < 1 ||
            inputs.capacity.value > 10,
    );
    checkField(inputs.date, "err-date", inputs.date.value === "");

    return isValid;
};
if (form) {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        if (!validateForm()) return;

        const newBooking = {
            id: inputs.idBook.value,
            name: inputs.name.value,
            room: inputs.room.value,
            capacity: inputs.capacity.value,
            date: inputs.date.value,
        };

        if (inputs.editId.value) {
            const index = bookingData.findIndex(
                (b) => b.id === inputs.editId.value,
            );
            if (index !== -1) {
                bookingData[index] = newBooking;
            }
        } else {
            if (bookingData.some((b) => b.id === newBooking.id)) {
                alert("ID Booking sudah digunakan!");
                return;
            }
            bookingData.push(newBooking);
        }

        renderTable();
        resetFormState();
    });
}
if (tableBody) {
    tableBody.addEventListener("click", (e) => {
        const target = e.target;

        if (target.classList.contains("btn-delete")) {
            const idToDelete = target.getAttribute("data-id");
            if (
                confirm(
                    `Apakah Anda yakin ingin membatalkan pesanan ruang untuk ID: ${idToDelete}?`,
                )
            ) {
                bookingData = bookingData.filter((b) => b.id !== idToDelete);
                renderTable();
            }
        }

        if (target.classList.contains("btn-edit")) {
            const idToEdit = target.getAttribute("data-id");
            const dataToEdit = bookingData.find((b) => b.id === idToEdit);

            if (dataToEdit) {
                inputs.idBook.value = dataToEdit.id;
                inputs.idBook.disabled = true;
                inputs.idBook.classList.add("bg-slate-100");
                inputs.name.value = dataToEdit.name;
                inputs.room.value = dataToEdit.room;
                inputs.capacity.value = dataToEdit.capacity;
                inputs.date.value = dataToEdit.date;
                inputs.editId.value = dataToEdit.id;

                formTitle.innerText = `Edit Pesanan: ${dataToEdit.id}`;
                document.getElementById("btn-submit").innerText =
                    "Simpan Perubahan";
                btnCancelEdit.classList.remove("hidden");

                document
                    .getElementById("booking-management")
                    .scrollIntoView({ behavior: "smooth" });
            }
        }
    });
}

// Event Listeners
if (btnCancelEdit) {
    btnCancelEdit.addEventListener("click", resetFormState);
}

if (searchInput) {
    searchInput.addEventListener("input", renderTable);
}

if (filterInput) {
    filterInput.addEventListener("change", renderTable);
}

const isBookingPage = document.getElementById("booking-form"); // Sesuaikan id form pemesananmu

if (isBookingPage) {
    refreshAutoId();
    renderTable();
}
