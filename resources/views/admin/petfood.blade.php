@include('layoutadmin.navbar')

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #EAE6E1;
        color: #6B4F3A;
        margin: 0;
    }
    .content {
        margin-left: 300px;
        padding: 40px 32px 32px 32px;
        max-width: 100%;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }
    .header h2 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #6B4F3A;
        letter-spacing: -0.02em;
    }
    .btn-add {
        background: #E57300;
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 12px 20px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }
    .btn-add:hover {
        background: #D16500;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(229,115,0,0.3);
    }
    .filter-container {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }
    select, input[type="text"] {
        padding: 12px 16px;
        border: 1px solid #ddd;
        border-radius: 12px;
        font-family: inherit;
        font-size: 0.95rem;
        transition: 0.3s;
        color: #6B4F3A;
        background: #F7F5F2;
        font-weight: 500;
    }
    select:focus, input:focus {
        border-color: #E57300;
        outline: none;
        box-shadow: 0 0 6px rgba(229,115,0,0.15);
        background: #fff;
    }
    .table-title {
        font-size: 1.3rem;
        font-weight: 800;
        margin: 30px 0 18px;
        color: #6B4F3A;
        letter-spacing: -0.01em;
    }
    .table-container {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(230,161,93,0.08);
        overflow: hidden;
        margin-bottom: 24px;
        border: 1px solid rgba(255,255,255,0.4);
        transition: 0.3s;
    }
    .table-container:hover {
        box-shadow: 0 12px 40px rgba(230,161,93,0.13);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 700px;
        background: #fff;
    }
    th {
        background: linear-gradient(135deg, #FFE0B2, #F9D9A7);
        padding: 20px 16px;
        text-align: left;
        font-weight: 700;
        font-size: 0.95rem;
        color: #6B4F3A;
        text-transform: uppercase;
        border-bottom: 2px solid rgba(169,123,93,0.1);
        letter-spacing: 0.5px;
    }
    td {
        padding: 20px 16px;
        border-top: 1px solid rgba(240,240,240,0.8);
        font-size: 0.98rem;
        color: #6B4F3A;
        font-weight: 500;
        vertical-align: middle;
    }
    td img {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 10px;
    }
    .action-btns {
        text-align: center;
    }
    .btn-edit, .btn-delete {
        border: none;
        padding: 8px 14px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.92rem;
        font-weight: 600;
        transition: 0.3s;
        margin-right: 6px;
    }
    .btn-edit {
        background: #FF9800;
        color: #fff;
    }
    .btn-edit:hover {
        background: #e68a00;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255,152,0,0.23);
    }
    .btn-delete {
        background: #DC3545;
        color: #fff;
        margin-right: 0;
    }
    .btn-delete:hover {
        background: #C82333;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220,53,69,0.22);
    }
    .btn-see-more {
        display: block;
        margin: 20px auto 0 auto;
        padding: 12px 28px;
        border-radius: 16px;
        border: none;
        background: #E57300;
        color: #fff;
        cursor: pointer;
        font-size: 0.98rem;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
        box-shadow: 0 4px 12px rgba(229,115,0,0.07);
    }
    .btn-see-more:hover {
        background: #D16500;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(229,115,0,0.17);
    }
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 25px;
    }
    .pagination button {
        padding: 9px 18px;
        border-radius: 12px;
        border: 1px solid #E57300;
        background: white;
        color: #6B4F3A;
        cursor: pointer;
        font-size: 0.96rem;
        font-weight: 600;
        transition: 0.3s;
    }
    .pagination button.active {
        background: #E57300;
        color: white;
        border-color: #E57300;
    }
    .pagination button:hover {
        background: #FFF3E0;
    }
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(107,79,58,0.7);
        justify-content: center;
        align-items: center;
    }
    .modal-content {
        background: #fff;
        border-radius: 24px;
        padding: 32px 38px;
        width: 420px;
        box-shadow: 0px 12px 40px rgba(107,79,58,0.18);
        animation: fadeIn 0.3s ease-in-out;
        text-align: left;
    }
    .modal-content h3 {
        margin-bottom: 20px;
        color: #6B4F3A;
        font-size: 1.3rem;
        font-weight: 800;
        text-align: center;
    }
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
        border-color: #E57300;
    }
    .modal-content input, .modal-content select {
        width: 100%;
        padding: 12px 16px;
        margin: 10px 0;
        border-radius: 12px;
        border: 1px solid #ddd;
        background: #F7F5F2;
        color: #6B4F3A;
        font-size: 0.98rem;
        font-weight: 500;
        transition: 0.3s;
    }
    .modal-content input:focus, .modal-content select:focus {
        border-color: #E57300;
        outline: none;
        box-shadow: 0 0 0 2px rgba(229,115,0,0.09);
        background: #fff;
    }
    .category-btns {
        display: flex;
        justify-content: space-between;
        margin: 15px 0;
    }
    .category-btns button {
        flex: 1;
        margin: 0 4px;
        padding: 10px 0;
        border-radius: 12px;
        border: 1px solid #E57300;
        background: #fff;
        color: #E57300;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.98rem;
        transition: 0.3s;
    }
    .category-btns button:hover {
        background: #FFF3E0;
    }
    .category-btns button.active {
        background: #E57300;
        color: #fff;
    }
    .modal-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
        gap: 10px;
    }
    .btn-cancel, .btn-save {
        padding: 12px 24px;
        border-radius: 12px;
        font-size: 0.96rem;
        cursor: pointer;
        transition: 0.3s;
        font-weight: 600;
        border: none;
    }
    .btn-cancel {
        background: #F7F5F2;
        color: #6B4F3A;
    }
    .btn-cancel:hover {
        background: #e8e5e0;
    }
    .btn-save {
        background: #E57300;
        color: #fff;
    }
    .btn-save:hover {
        background: #D16500;
    }
    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(-20px);}
        to {opacity: 1; transform: translateY(0);}
    }
    @media (max-width: 1000px) {
        .content {padding: 20px 10px;}
        .table-container {padding: 0;}
        th, td {padding: 14px 8px;}
    }
</style>

<div class="content">
    <div class="header">
        <h2>All Listed Pet Food</h2>
        <button class="btn-add" onclick="openAddProductModal()"><i class="bi bi-plus-circle"></i> Add Product</button>
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
    const closeAddBtn = document.querySelector("#closeModal");
    const closeEditBtn = document.querySelector("#closeEditModal");

    window.openAddProductModal = function() {
        addModal.style.display = "flex";
        document.body.style.overflow = "hidden";
    };
    closeAddBtn.addEventListener("click", () => {
        addModal.style.display = "none";
        document.body.style.overflow = "auto";
    });
    window.openEditProductModal = function(name, price, category, stock) {
        editModal.style.display = "flex";
        document.body.style.overflow = "hidden";
        const inputs = editModal.querySelectorAll("input");
        inputs[1].value = name;   // nama produk
        inputs[2].value = price;  // harga
        inputs[3].value = stock;  // stok
        editModal.querySelectorAll(".category-btns button").forEach(btn => {
            btn.classList.remove("active");
            if (btn.textContent.trim() === category) {
                btn.classList.add("active");
            }
        });
    };
    closeEditBtn.addEventListener("click", () => {
        editModal.style.display = "none";
        document.body.style.overflow = "auto";
    });
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
    document.querySelectorAll(".category-btns button").forEach(btn => {
        btn.addEventListener("click", () => {
            const parent = btn.parentElement;
            parent.querySelectorAll("button").forEach(b => b.classList.remove("active"));
            btn.classList.add("active");
        });
    });
});
</script>