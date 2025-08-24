@include('layoutadmin.navbar')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f5f6fa;
        color: #333;
        margin: 0;
    }

    .content {
        margin-left: 300px; 
        padding: 30px;
    }

    /* Header */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .header h2 {
        font-size: 26px;
        font-weight: 700;
        color: #2d3436;
    }

    .btn-add {
        background: #5A3B2E;
        color: #fff;
        padding: 10px 18px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.3s;
        font-weight: 500;
    }

    .btn-add:hover {
        background: #7a5242;
        transform: translateY(-2px);
    }

    /* Filter Section */
    .filter-container {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    select, input {
        padding: 9px 14px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-family: inherit;
        font-size: 14px;
        transition: 0.3s;
    }

    select:focus, input:focus {
        border-color: #5A3B2E;
        outline: none;
        box-shadow: 0 0 6px rgba(90,59,46,0.2);
    }

    /* Table Section Title */
    .table-title {
        font-size: 20px;
        font-weight: 600;
        margin: 30px 0 15px;
        color: #444;
    }

    /* Table Card */
    .table-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 20px;
        transition: 0.3s;
    }

    .table-container:hover {
        box-shadow: 0 6px 14px rgba(0,0,0,0.08);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #fafafa;
        padding: 14px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        color: #555;
    }

    td {
        padding: 14px;
        border-top: 1px solid #eee;
        font-size: 14px;
        color: #444;
    }

    td img {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 8px;
    }

    /* Action Buttons */
    .action-btns {
        text-align: center;
    }

    .btn-edit, .btn-delete {
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-edit {
        background: #F4A261;
        color: #fff;
        margin-right: 5px;
    }

    .btn-edit:hover {
        background: #e0863a;
        transform: scale(1.05);
    }

    .btn-delete {
        background: #e63946;
        color: #fff;
    }

    .btn-delete:hover {
        background: #c71c2f;
        transform: scale(1.05);
    }

    /* See More Button */
    .btn-see-more {
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        background: #5A3B2E;
        color: #fff;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-see-more:hover {
        background: #7a5242;
        transform: translateY(-2px);
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 25px;
    }

    .pagination button {
        padding: 7px 14px;
        border-radius: 8px;
        border: 1px solid #ccc;
        background: white;
        cursor: pointer;
        font-size: 13px;
        transition: 0.3s;
    }

    .pagination button.active {
        background: #5A3B2E;
        color: white;
        border-color: #5A3B2E;
    }

    .pagination button:hover {
        background: #eee;
    }

    .modal {
        display: none; 
        position: fixed; 
        z-index: 1000; 
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%; 
        background-color: rgba(0,0,0,0.6);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: #fff;
        border-radius: 14px;
        padding: 25px 30px;
        width: 420px;
        box-shadow: 0px 6px 16px rgba(0,0,0,0.12);
        animation: fadeIn 0.3s ease-in-out;
        text-align: left;
    }

    .modal-content h3 {
        margin-bottom: 20px;
        color: #2d3436;
        font-size: 20px;
        font-weight: 600;
        text-align: center;
    }

    /* Image Upload Box */
    .image-upload {
        width: 120px;
        height: 120px;
        background: #f1f1f1;
        border: 2px dashed #ccc;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 15px auto;
        font-size: 28px;
        color: #777;
        cursor: pointer;
        transition: 0.3s;
    }
    .image-upload:hover {
        background: #fafafa;
        border-color: #5A3B2E;
    }

    /* Inputs */
    .modal-content input {
        width: 100%;
        padding: 10px 14px;
        margin: 8px 0;
        border-radius: 8px;
        border: 1px solid #ddd;
        background: #fff;
        color: #333;
        font-size: 14px;
        transition: 0.3s;
    }
    .modal-content input:focus {
        border-color: #5A3B2E;
        outline: none;
        box-shadow: 0 0 0 2px rgba(90,59,46,0.1);
    }

    /* Category Buttons */
    .category-btns {
        display: flex;
        justify-content: space-between;
        margin: 15px 0;
    }
    .category-btns button {
        flex: 1;
        margin: 0 4px;
        padding: 8px;
        border-radius: 8px;
        border: 1px solid #5A3B2E;
        background: #fff;
        color: #5A3B2E;
        cursor: pointer;
        font-weight: 500;
        transition: 0.3s;
    }
    .category-btns button:hover {
        background: #f7f3f2;
    }
    .category-btns button.active {
        background: #5A3B2E;
        color: #fff;
    }

    /* Actions */
    .modal-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
        gap: 10px;
    }
    .btn-cancel, .btn-save {
        padding: 10px 18px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: 0.3s;
        font-weight: 500;
    }
    .btn-cancel {
        background: #fff;
        border: 1px solid #ccc;
        color: #555;
    }
    .btn-cancel:hover {
        background: #f1f1f1;
    }
    .btn-save {
        background: #5A3B2E;
        border: none;
        color: #fff;
    }
    .btn-save:hover {
        background: #7a5242;
    }

    /* Animation */
    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(-20px);}
        to {opacity: 1; transform: translateY(0);}
    }

</style>


<div class="content">
    <div class="header">
        <h2>All Listed Pet Food</h2>
        <button class="btn-add" onclick="openAddProductModal()">+ Add Product</button>
    </div>

    <!-- FILTER -->
    <div class="filter-container">
        <select>
            <option>Filter by Category</option>
            <option>Cat Food</option>
            <option>Dog Food</option>
        </select>

        <select>
            <option>Sort by Price</option>
            <option>Lowest to Highest</option>
            <option>Highest to Lowest</option>
        </select>

        <input type="text" placeholder="Search product...">
    </div>

    <!-- TABLE -->
    <h3 class="table-title">Pet Food List</h3>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th style="text-align:center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="{{ asset('images/whiskas.svg') }}" alt="Whiskas"></td>
                    <td>Whiskas</td>
                    <td>Cat Food</td>
                    <td>Rp. 200.000</td>
                    <td class="action-btns">
                        <button class="btn-edit" onclick="openEditProductModal('Whiskas','Rp. 200.000','Cat Food',10)">Edit</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td><img src="{{ asset('images/whiskas.svg') }}" alt="Pedigree"></td>
                    <td>Pedigree</td>
                    <td>Dog Food</td>
                    <td>Rp. 180.000</td>
                    <td class="action-btns">
                    <button class="btn-edit" onclick="openEditProductModal('Pedigree','Rp. 180.000','Dog Food',10)">Edit</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="pagination">
        <button>&laquo;</button>
        <button class="active">1</button>
        <button>2</button>
        <button>3</button>
        <button>&raquo;</button>
    </div>
</div>

<!-- ====== Modal Add Product ====== -->
<div class="modal" id="addProductModal">
    <div class="modal-content">
        <h3>New Product</h3>
        <div class="image-upload" onclick="document.getElementById('addProductImage').click()">
            <span id="addImagePreview">📷</span>
        </div>
        <input type="file" id="addProductImage" accept="image/*" style="display:none">        
        <input type="text" placeholder="Enter product name">
        <input type="text" placeholder="Enter product price">
        <div class="category-btns">
            <button type="button" class="active">Pet Food</button>
            <button type="button">Supplies</button>
            <button type="button">Vitamin</button>
        </div>

        <input type="number" placeholder="Enter stock">

        <div class="modal-actions">
            <button class="btn-cancel" id="closeModal">Back</button>
            <button class="btn-save">Add</button>
        </div>
    </div>
</div>

<!-- ====== Modal Edit Product ====== -->
<div class="modal" id="editProductModal">
    <div class="modal-content">
        <h3>Edit Product</h3>
        
        <div class="image-upload" onclick="document.getElementById('addProductImage').click()">
            <span id="addImagePreview">📷</span>
        </div>
        
        <input type="file" id="addProductImage" accept="image/*" style="display:none">        
        <input type="text" placeholder="Enter product name">
        <input type="text" placeholder="Enter product price">

        <div class="category-btns">
            <button type="button" class="active">Pet Food</button>
            <button type="button">Supplies</button>
            <button type="button">Vitamin</button>
        </div>

        <input type="number" id="editProductStock" placeholder="Enter stock" value="10">

        <div class="modal-actions">
            <button class="btn-cancel" id="closeEditModal">Back</button>
            <button class="btn-save">Save Changes</button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const addModal = document.getElementById("addProductModal");
    const editModal = document.getElementById("editProductModal");

    const openAddBtn = document.querySelector(".btn-add");
    const closeAddBtn = document.querySelector("#closeModal");
    const closeEditBtn = document.querySelector("#closeEditModal");

    // === Buka Modal Tambah Produk ===
    window.openAddProductModal = function() {
        addModal.style.display = "flex";
        document.body.style.overflow = "hidden";
    };

    // === Tutup Modal Tambah Produk ===
    closeAddBtn.addEventListener("click", () => {
        addModal.style.display = "none";
        document.body.style.overflow = "auto";
    });

    // === Buka Modal Edit Produk ===
    window.openEditProductModal = function(name, price, category, stock) {
        editModal.style.display = "flex";
        document.body.style.overflow = "hidden";

        // isi data ke input
        const inputs = editModal.querySelectorAll("input");
        inputs[1].value = name;   // nama produk
        inputs[2].value = price;  // harga
        inputs[3].value = stock;  // stok

        // set kategori aktif
        editModal.querySelectorAll(".category-btns button").forEach(btn => {
            btn.classList.remove("active");
            if (btn.textContent.trim() === category) {
                btn.classList.add("active");
            }
        });
    };

    // === Tutup Modal Edit Produk ===
    closeEditBtn.addEventListener("click", () => {
        editModal.style.display = "none";
        document.body.style.overflow = "auto";
    });

    // === Tutup Modal jika klik luar konten ===
    window.addEventListener("click", (e) => {
        if (e.target === addModal) {
            addModal.style.display = "none";
            document.body.style.overflow = "auto";
        }
        if (e.target === editModal) {
            editModal.style.display = "none";
            document.body.style.overflow = "auto";
        }
    });

    // === Ganti kategori (Add/Edit) ===
    document.querySelectorAll(".category-btns button").forEach(btn => {
        btn.addEventListener("click", () => {
            const parent = btn.parentElement;
            parent.querySelectorAll("button").forEach(b => b.classList.remove("active"));
            btn.classList.add("active");
        });
    });
});
</script>
