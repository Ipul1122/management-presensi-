



document.addEventListener("DOMContentLoaded", function () {
    // Select all functionality
    const selectAll = document.getElementById("selectAll");
    const checkboxes = document.querySelectorAll(".murid-checkbox");
    const selectedCount = document.getElementById("selectedCount");
    const bulkDeleteBtn = document.getElementById("bulkDeleteBtn");

    function updateSelectedCount() {
        const checkedBoxes = document.querySelectorAll(
            ".murid-checkbox:checked"
        );
        const count = checkedBoxes.length;
        selectedCount.textContent = count;

        if (count > 0) {
            selectedCount.classList.remove("hidden");
        } else {
            selectedCount.classList.add("hidden");
        }
    }

    selectAll.addEventListener("change", function () {
        checkboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
        updateSelectedCount();
    });

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            updateSelectedCount();

            // Update selectAll checkbox
            const allChecked =
                document.querySelectorAll(".murid-checkbox:not(:checked)")
                    .length === 0;
            selectAll.checked = allChecked && checkboxes.length > 0;
        });
    });

    // Search and filter functionality
    const searchInput = document.getElementById("searchInput");
    const genderFilter = document.getElementById("genderFilter");
    const classFilter = document.getElementById("classFilter");
    const rows = document.querySelectorAll(".murid-row");

    function filterRows() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedGender = genderFilter.value;
        const selectedClass = classFilter.value;

        rows.forEach((row) => {
            const name = row
                .querySelector("td:nth-child(4)")
                .textContent.toLowerCase();
            const gender = row
                .querySelector("td:nth-child(5) span")
                .textContent.trim();
            const kelasElement = row.querySelector("td:nth-child(7) span");
            const kelas = kelasElement ? kelasElement.textContent.trim() : "";

            const matchesSearch = name.includes(searchTerm);
            const matchesGender = !selectedGender || gender === selectedGender;
            const matchesClass = !selectedClass || kelas === selectedClass;

            const shouldShow = matchesSearch && matchesGender && matchesClass;
            row.classList.toggle("hidden", !shouldShow);
        });
    }

    searchInput.addEventListener("keyup", filterRows);
    genderFilter.addEventListener("change", filterRows);
    classFilter.addEventListener("change", filterRows);

    // Single delete modal
    const deleteModal = document.getElementById("deleteModal");
    const deleteButtons = document.querySelectorAll(".delete-btn");
    const cancelDelete = document.getElementById("cancelDelete");
    const deleteModalName = document.getElementById("deleteModalName");
    const deleteSingleItemForm = document.getElementById(
        "deleteSingleItemForm"
    );

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            const name = this.getAttribute("data-name");

            deleteModalName.textContent = name;
            deleteSingleItemForm.action = `/admin/murid/${id}`;
            deleteModal.classList.remove("hidden");
        });
    });

    cancelDelete.addEventListener("click", function () {
        deleteModal.classList.add("hidden");
    });

    // Close modal if clicked outside
    deleteModal.addEventListener("click", function (e) {
        if (e.target === deleteModal) {
            deleteModal.classList.add("hidden");
        }
    });

    // Bulk delete modal
    const bulkDeleteModal = document.getElementById("bulkDeleteModal");
    const bulkDeleteCount = document.getElementById("bulkDeleteCount");
    const cancelBulkDelete = document.getElementById("cancelBulkDelete");
    const confirmBulkDelete = document.getElementById("confirmBulkDelete");
    const muridListForm = document.getElementById("muridListForm");

    bulkDeleteBtn.addEventListener("click", function () {
        const checkedBoxes = document.querySelectorAll(
            ".murid-checkbox:checked"
        );
        const count = checkedBoxes.length;

        if (count === 0) {
            // Show alert if no items selected
            alert("Silakan pilih minimal satu data untuk dihapus.");
            return;
        }

        bulkDeleteCount.textContent = count;
        bulkDeleteModal.classList.remove("hidden");
    });

    cancelBulkDelete.addEventListener("click", function () {
        bulkDeleteModal.classList.add("hidden");
    });

    confirmBulkDelete.addEventListener("click", function () {
        muridListForm.submit();
    });

    // Close modal if clicked outside
    bulkDeleteModal.addEventListener("click", function (e) {
        if (e.target === bulkDeleteModal) {
            bulkDeleteModal.classList.add("hidden");
        }
    });

    // View murid details modal
    const viewModal = document.getElementById("viewModal");
    const viewButtons = document.querySelectorAll(".view-btn");
    const closeViewModal = document.getElementById("closeViewModal");
    const viewModalContent = document.getElementById("viewModalContent");

    viewButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            viewModal.classList.remove("hidden");

            // Here you would normally make an AJAX request to get the details
            // For now, we'll simulate loading with a timeout
            setTimeout(() => {
                // This would be replaced with actual data from your backend
                const dummyData = {
                    nama_anak: document
                        .querySelector(`[data-id="${id}"]`)
                        .closest("tr")
                        .querySelector("td:nth-child(4) div").textContent,
                    foto:
                        document
                            .querySelector(`[data-id="${id}"]`)
                            .closest("tr")
                            .querySelector("td:nth-child(3) img")?.src || null,
                    jenis_kelamin: document
                        .querySelector(`[data-id="${id}"]`)
                        .closest("tr")
                        .querySelector("td:nth-child(5) span")
                        .textContent.trim(),
                    kelas: document
                        .querySelector(`[data-id="${id}"]`)
                        .closest("tr")
                        .querySelector("td:nth-child(7) span")
                        .textContent.trim(),
                    alamat: document
                        .querySelector(`[data-id="${id}"]`)
                        .closest("tr")
                        .querySelector("td:nth-child(6) div").textContent,
                    tanggal_daftar: document
                        .querySelector(`[data-id="${id}"]`)
                        .closest("tr")
                        .querySelector("td:nth-child(8)")
                        .textContent.trim(),
                };

                // Update modal content with the data
                let photoHtml = "";
                if (dummyData.foto) {
                    photoHtml = `<img src="${dummyData.foto}" class="h-32 w-32 rounded-full object-cover border-4 border-white shadow-lg" alt="Foto Murid">`;
                } else {
                    photoHtml = `
                        <div class="h-32 w-32 rounded-full bg-blue-100 flex items-center justify-center text-blue-500">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    `;
                }

                viewModalContent.innerHTML = `
                    <div class="flex flex-col items-center mb-6">
                        ${photoHtml}
                        <h3 class="text-xl font-bold mt-4">${
                            dummyData.nama_anak
                        }</h3>
                        <div class="flex space-x-2 mt-2">
                            <span class="px-3 py-1 text-sm font-medium rounded-full ${
                                dummyData.jenis_kelamin.includes("Laki")
                                    ? "bg-blue-100 text-blue-800"
                                    : "bg-pink-100 text-pink-800"
                            }">
                                ${dummyData.jenis_kelamin}
                            </span>
                            <span class="px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-800">
                                ${dummyData.kelas}
                            </span>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">ID Pendaftaran</h4>
                                <p class="text-gray-900">${id}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Tanggal Daftar</h4>
                                <p class="text-gray-900">${
                                    dummyData.tanggal_daftar
                                }</p>
                            </div>
                            <div class="col-span-1 md:col-span-2">
                                <h4 class="text-sm font-medium text-gray-500">Alamat</h4>
                                <p class="text-gray-900">${dummyData.alamat}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <a href="/admin/murid/${id}/edit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                            Edit
                        </a>
                        <button type="button" class="delete-btn-modal inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200" 
                            data-id="${id}" 
                            data-name="${dummyData.nama_anak}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </button>
                    </div>
                `;

                // Add event listener to the delete button in the modal
                const deleteButtonInModal =
                    viewModalContent.querySelector(".delete-btn-modal");
                deleteButtonInModal.addEventListener("click", function () {
                    const id = this.getAttribute("data-id");
                    const name = this.getAttribute("data-name");

                    deleteModalName.textContent = name;
                    deleteSingleItemForm.action = `/admin/murid/${id}`;
                    viewModal.classList.add("hidden");
                    deleteModal.classList.remove("hidden");
                });
            }, 500);
        });
    });

    closeViewModal.addEventListener("click", function () {
        viewModal.classList.add("hidden");
    });

    // Close modal if clicked outside
    viewModal.addEventListener("click", function (e) {
        if (e.target === viewModal) {
            viewModal.classList.add("hidden");
        }
    });

    // Alert auto-close
    const alerts = document.querySelectorAll("#alert-success, #alert-error");
    alerts.forEach((alert) => {
        setTimeout(() => {
            alert.classList.add(
                "opacity-0",
                "transition-opacity",
                "duration-500"
            );
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });

    // Add animation for table rows
    rows.forEach((row, index) => {
        row.style.opacity = "0";
        row.style.animation = `fadeIn 0.3s ease forwards ${index * 0.05}s`;
    });

    // Tambahkan event listener untuk memastikan filter dijalankan saat halaman dimuat
    filterRows();

    // Tambahkan event listener untuk perubahan pada dropdown kelas
    classFilter.addEventListener("change", function () {
        console.log("Class filter changed to:", this.value);
        filterRows();
    });
});

// Add needed CSS animation
document.head.insertAdjacentHTML(
    "beforeend",
    `
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        /* Responsive adjustments */
        @media (max-width: 640px) {
            .overflow-x-auto {
                margin: 0 -1rem;
                width: calc(100% + 2rem);
            }
        }
    </style>
`
);
