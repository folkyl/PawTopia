@extends('layouts.app')
@include('layoutadmin.navbar')

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #EAE6E1;
        margin: 0;
        color: #6B4F3A;
    }
    .dashboard-root {
        display: flex;
        min-height: 100vh;
        background: #EAE6E1;
    }
    .dashboard-main {
        flex: 1;
        padding: 40px 32px 32px 32px;
        max-width: 100%;
        margin-left: 250px;
    }
    .dashboard-header {
        background: #fff;
        border-radius: 24px;
        padding: 24px 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        box-shadow: 0 8px 32px rgba(230, 161, 93, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .header-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: #6B4F3A;
        letter-spacing: -0.02em;
    }
    .header-subtitle {
        color: #A97B5D;
        font-size: 1rem;
        font-weight: 500;
    }
    .btn-add-product {
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
    .btn-add-product:hover {
        background: #D16500;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(229, 115, 0, 0.3);
    }
    .category-card {
        background: linear-gradient(135deg, #fff 0%, #fefefe 100%);
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 12px 40px rgba(230, 161, 93, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.5);
        margin-bottom: 32px;
        animation: fadeInUp 0.6s ease forwards;
    }
    .category-title {
        font-weight:800;
        font-size:1.3rem;
        color:#6B4F3A;
        margin-bottom:24px;
        letter-spacing:-0.01em;
    }
    /* Table Styles */
    .table-container {
        overflow-x: auto;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 24px;
    }
    .product-table {
        width: 100%;
        min-width: 800px;
        background: #fff;
        border-collapse: collapse;
    }
    .product-table thead tr {
        background: linear-gradient(135deg, #FFE0B2, #F9D9A7);
    }
    .product-table th {
        color: #6B4F3A;
        padding: 20px 16px;
        font-weight: 700;
        text-align: left;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid rgba(169, 123, 93, 0.1);
    }
    .product-table td {
        padding: 20px 16px;
        border-bottom: 1px solid rgba(240, 240, 240, 0.8);
        color: #6B4F3A;
        vertical-align: middle;
        font-weight: 500;
    }
    .product-table td img {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        object-fit: cover;
    }
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }
    .action-btn {
        border: none;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        text-transform: capitalize;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .btn-edit {
        background: #FF9800;
        color: #fff;
    }
    .btn-edit:hover {
        background: #e68a00;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 152, 0, 0.3);
    }
    .btn-delete {
        background: #DC3545;
        color: #fff;
    }
    .btn-delete:hover {
        background: #C82333;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }
    .btn-see-more {
        background: #E57300;
        color:#fff;
        border:none;
        border-radius:12px;
        padding:10px 20px;
        font-weight:600;
        cursor:pointer;
        transition:all 0.3s ease;
        display:inline-block;
        margin-top: 10px;
        margin-left: auto;
        margin-right: 0;
        font-size:0.9rem;
    }
    .btn-see-more:hover {
        background: #D16500;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(229, 115, 0, 0.2);
    }
    /* Modal Style */
    .modal-overlay {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(107, 79, 58, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    .modal-container {
        background: linear-gradient(135deg, #fff 0%, #fefefe 100%);
        border-radius: 24px;
        width: 90%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(107, 79, 58, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.5);
        transform: translateY(30px);
        opacity: 0;
        transition: all 0.4s ease;
        padding: 50px;
    }
    .modal-overlay.active .modal-container {
        transform: translateY(0);
        opacity: 1;
    }
    .modal-header {
        padding: 24px 32px 16px;
        border-bottom: 1px solid rgba(169, 123, 93, 0.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-title {
        font-weight: 800;
        font-size: 1.5rem;
        color: #6B4F3A;
        margin: 0;
    }
    .modal-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #A97B5D;
        cursor: pointer;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    .modal-close:hover {
        background: rgba(169, 123, 93, 0.1);
        color: #6B4F3A;
        transform: rotate(90deg);
    }
    .modal-body {
        padding: 24px 32px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #6B4F3A;
        font-size: 0.9rem;
    }
    .form-input, .form-select {
        width: 100%;
        background: #F7F5F2;
        border: 1px solid rgba(169, 123, 93, 0.2);
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 0.9rem;
        color: #6B4F3A;
        transition: all 0.3s ease;
        font-weight: 500;
    }
    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: #E57300;
        box-shadow: 0 0 0 3px rgba(229, 115, 0, 0.1);
        background: #fff;
    }
    .modal-footer {
        padding: 16px 32px 24px;
        border-top: 1px solid rgba(169, 123, 93, 0.2);
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }
    .modal-btn {
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }
    .btn-cancel {
        background: #F7F5F2;
        color: #6B4F3A;
    }
    .btn-cancel:hover {
        background: #e8e5e0;
        transform: translateY(-2px);
    }
    .btn-save {
        background: #E57300;
        color: #fff;
    }
    .btn-save:hover {
        background: #D16500;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(229, 115, 0, 0.3);
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px);}
        to { opacity: 1; transform: translateY(0);}
    }
    /* Responsive */
    @media (max-width: 1200px) {
        .dashboard-main { padding: 20px 16px; }
        .category-card { padding: 20px; }
        .product-table th, .product-table td { padding: 16px 12px; }
    }
    @media (max-width: 768px) {
        .dashboard-main { padding: 12px 6px;}
        .dashboard-header { flex-direction: column; gap: 16px; text-align: center; padding: 20px;}
        .category-card { padding: 16px 10px; border-radius: 16px;}
        .product-table th, .product-table td { padding: 12px 8px; font-size:0.85rem;}
    }
</style>


<div class="dashboard-root">
    <main class="dashboard-main">
        <!-- Header -->
        <div class="dashboard-header">
            <div>
                <span class="header-title">Product Management</span>
                <div class="header-subtitle">Kelola produk pet boarding sesuai kategori</div>
            </div>
            <button class="btn-add-product" onclick="openAddProductModal()">
                <i class="bi bi-plus-circle"></i> Tambah Produk
            </button>
        </div>

        <!-- Pet Food Section -->
        <div class="category-card">
            <div class="category-title">Pet Food</div>
            <div class="table-container">
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="{{ asset('images/whiskas.svg') }}" alt="Whiskas"></td>
                            <td>Whiskas</td>
                            <td>Cat Food</td>
                            <td>Rp. 200.000</td>
                            <td>10</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn btn-edit" onclick="openEditProductModal('Whiskas','Rp. 200.000','Cat Food',10)">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="action-btn btn-delete">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="{{ asset('images/whiskas.svg') }}" alt="Pedigree"></td>
                            <td>Pedigree</td>
                            <td>Dog Food</td>
                            <td>Rp. 180.000</td>
                            <td>15</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn btn-edit" onclick="openEditProductModal('Pedigree','Rp. 180.000','Dog Food',15)">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="action-btn btn-delete">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="{{ route('admin.petfood') }}" class="btn-see-more">See More</a>
        </div>

        <!-- Supplies Section -->
        <div class="category-card">
            <div class="category-title">Pet Supplies</div>
            <div class="table-container">
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="{{ asset('images/whiskas.svg') }}" alt="Pet Shampoo"></td>
                            <td>Pet Shampoo</td>
                            <td>Supplies</td>
                            <td>Rp. 75.000</td>
                            <td>20</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn btn-edit" onclick="openEditProductModal('Pet Shampoo','Rp. 75.000','Supplies',20)">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="action-btn btn-delete">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="{{ asset('images/whiskas.svg') }}" alt="Litter Box"></td>
                            <td>Litter Box</td>
                            <td>Supplies</td>
                            <td>Rp. 150.000</td>
                            <td>8</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn btn-edit" onclick="openEditProductModal('Litter Box','Rp. 150.000','Supplies',8)">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="action-btn btn-delete">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="{{ route('admin.petsupplies') }}" class="btn-see-more">See More</a>
        </div>

        <!-- Vitamins Section -->
        <div class="category-card">
            <div class="category-title">Pet Vitamins</div>
            <div class="table-container">
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="{{ asset('images/whiskas.svg') }}" alt="Vitamin A"></td>
                            <td>Vitamin A</td>
                            <td>Vitamin</td>
                            <td>Rp. 50.000</td>
                            <td>12</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn btn-edit" onclick="openEditProductModal('Vitamin A','Rp. 50.000','Vitamin',12)">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="action-btn btn-delete">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="{{ asset('images/whiskas.svg') }}" alt="Vitamin B"></td>
                            <td>Vitamin B Complex</td>
                            <td>Vitamin</td>
                            <td>Rp. 85.000</td>
                            <td>7</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn btn-edit" onclick="openEditProductModal('Vitamin B Complex','Rp. 85.000','Vitamin',7)">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="action-btn btn-delete">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="{{ route('admin.petvitamins') }}" class="btn-see-more">See More</a>
        </div>
    </main>
</div>

<!-- Modal Add Product -->
<div class="modal-overlay" id="addProductModal">
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="modal-title">Tambah Produk</h2>
            <button class="modal-close" onclick="closeAddModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="addProductForm">
                <div class="form-group">
                    <label for="addProductName" class="form-label">Nama Produk</label>
                    <input type="text" id="addProductName" class="form-input" placeholder="Nama produk" required>
                </div>
                <div class="form-group">
                    <label for="addProductCategory" class="form-label">Kategori</label>
                    <select id="addProductCategory" class="form-select" required>
                        <option value="">Pilih kategori</option>
                        <option value="Cat Food">Cat Food</option>
                        <option value="Dog Food">Dog Food</option>
                        <option value="Supplies">Supplies</option>
                        <option value="Vitamin">Vitamin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="addProductPrice" class="form-label">Harga</label>
                    <input type="text" id="addProductPrice" class="form-input" placeholder="Rp. 0" required>
                </div>
                <div class="form-group">
                    <label for="addProductStock" class="form-label">Stok</label>
                    <input type="number" id="addProductStock" class="form-input" placeholder="Stok" min="0" required>
                </div>
                <div class="form-group">
                    <label for="addProductImage" class="form-label">Gambar</label>
                    <input type="file" id="addProductImage" class="form-input" accept="image/*">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="modal-btn btn-cancel" onclick="closeAddModal()">Batal</button>
            <button class="modal-btn btn-save" onclick="submitAddProduct()">Tambah Produk</button>
        </div>
    </div>
</div>

<!-- Modal Edit Product -->
<div class="modal-overlay" id="editProductModal">
    <div class="modal-container">
        <div class="modal-header">
            <h2 class="modal-title">Edit Produk</h2>
            <button class="modal-close" onclick="closeEditModal()">
                <i class="bi bi-x"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="editProductForm">
                <div class="form-group">
                    <label for="editProductName" class="form-label">Nama Produk</label>
                    <input type="text" id="editProductName" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="editProductCategory" class="form-label">Kategori</label>
                    <select id="editProductCategory" class="form-select" required>
                        <option value="Cat Food">Cat Food</option>
                        <option value="Dog Food">Dog Food</option>
                        <option value="Supplies">Supplies</option>
                        <option value="Vitamin">Vitamin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editProductPrice" class="form-label">Harga</label>
                    <input type="text" id="editProductPrice" class="form-input" required>
                </div>
                <div class="form-group">
                    <label for="editProductStock" class="form-label">Stok</label>
                    <input type="number" id="editProductStock" class="form-input" min="0" required>
                </div>
                <div class="form-group">
                    <label for="editProductImage" class="form-label">Gambar</label>
                    <input type="file" id="editProductImage" class="form-input" accept="image/*">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="modal-btn btn-cancel" onclick="closeEditModal()">Batal</button>
            <button class="modal-btn btn-save" onclick="submitEditProduct()">Simpan Perubahan</button>
        </div>
    </div>
</div>

<script>
    function openAddProductModal() {
        document.getElementById('addProductForm').reset();
        document.getElementById('addProductModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeAddModal() {
        document.getElementById('addProductModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    function openEditProductModal(name, price, category, stock) {
        document.getElementById('editProductName').value = name;
        document.getElementById('editProductPrice').value = price;
        document.getElementById('editProductCategory').value = category;
        document.getElementById('editProductStock').value = stock;
        document.getElementById('editProductModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeEditModal() {
        document.getElementById('editProductModal').classList.remove('active');
        document.body.style.overflow = '';
    }
    function submitAddProduct() {
        // Logic tambah produk (push ke array, refresh tabel, dsb)
        closeAddModal();
        alert('Produk baru berhasil ditambahkan!');
    }
    function submitEditProduct() {
        // Logic edit produk (update array, refresh tabel, dsb)
        closeEditModal();
        alert('Produk berhasil diupdate!');
    }
    // Close modal with ESC key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeAddModal();
            closeEditModal();
        }
    });
    // Close modal when click outside
    document.getElementById('addProductModal').addEventListener('click', function (e) {
        if (e.target === this) closeAddModal();
    });
    document.getElementById('editProductModal').addEventListener('click', function (e) {
        if (e.target === this) closeEditModal();
    });
</script>