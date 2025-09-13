@include ('layouts.navbar')
@extends('layouts.app')

@section('content')
<!-- Custom CSS -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
body {
    background: #fff;
    font-family: 'Poppins', Arial, sans-serif;
    margin: 0;
    padding: 0;
}
.shop-hero {
    background: #FFE0B2;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 32px;
    padding: 60px 80px;
    margin: 150px auto 0 auto; /* Increased top margin */
    max-width: 1400px;
    width: 95%;
    min-height: 250px;
    box-shadow: 0 4px 24px #e6a15d22;
    position: relative;
    overflow: visible;
}
.shop-hero-content {
    max-width: 60%;
}

.shop-hero-content h2 {
    font-weight: 700;
    color: #8D5B2D;
    font-size: 2.2rem;
    margin-bottom: 0.8rem;
    letter-spacing: -1px;
    text-align: left;
}
.shop-hero-content p {
    color: #8D5B2D;
    font-size: 1.1rem;
    font-weight: 400;
    text-align: left;
    line-height: 1.6;
    margin: 0;
}
.shop-hero-img {
    height: 420px;
    position: absolute;
    right: -0px;
    bottom: -1px;
    z-index: 10;
}

/* ===== Search Section ===== */
.search-section {
    max-width: 1400px; /* Match hero's max-width */
    margin: 20px auto 40px auto;
    padding: 0;
    display: flex;
    justify-content: flex-end;
    position: relative;
    z-index: 5;
    width: 95%; /* Match hero's width */
    right: 0;
}

.search-container {
    position: relative;
    width: 400px;
    max-width: 100%;
    background: #fff;
    border-radius: 50px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.search-container:focus-within {
    box-shadow: 0 6px 24px rgba(141, 91, 45, 0.15);
    transform: translateY(-2px);
}

.search-box {
    width: 100%;
    padding: 16px 60px 16px 55px;
    border: 2px solid #F0E6D6;
    border-radius: 50px;
    font-size: 1.05rem;
    font-family: 'Poppins', sans-serif;
    background: #fff;
    color: #4A2C12;
    outline: none;
    transition: all 0.3s ease;
}

.search-box:focus {
    border-color: #E6A15D;
    box-shadow: 0 0 0 4px rgba(230, 161, 93, 0.2);
}

.search-box::placeholder {
    color: #B7B2AA;
    font-weight: 400;
    letter-spacing: 0.3px;
}

.search-icon {
    position: absolute;
    left: 22px;
    top: 50%;
    transform: translateY(-50%);
    color: #E6A15D;
    font-size: 1.1rem;
    pointer-events: none;
}

.search-clear {
    position: absolute;
    right: 18px;
    top: 50%;
    transform: translateY(-50%);
    background: #F5F5F5;
    border: none;
    border-radius: 50%;
    color: #B7B2AA;
    cursor: pointer;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    opacity: 0;
    visibility: hidden;
}

.search-clear.visible {
    opacity: 1;
    visibility: visible;
}

.search-clear:hover {
    background: #E6A15D;
    color: #fff;
}

.search-clear i {
    font-size: 0.9rem;
}

/* No Results Message */
.no-results {
    text-align: center;
    padding: 60px 20px;
    color: #666;
    font-size: 1.1rem;
    display: none;
}

.no-results i {
    font-size: 4rem;
    color: #E6A15D;
    margin-bottom: 20px;
    display: block;
}

/* Category Sections */
.category-section {
    max-width: 1200px;
    margin: 0 auto 48px auto;
    padding: 0 24px;
}
.category-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 32px;
}
.category-title {
    background: #8D5B2D;
    color: #fff;
    border-radius: 32px;
    padding: 12px 32px;
    font-weight: 700;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 16px rgba(141, 91, 45, 0.3);
}
.subcategory-tabs {
    display: flex;
    gap: 16px;
    margin-bottom: 24px;
}
.subcategory-tab {
    background: #fff;
    border: 2px solid #E6A15D;
    border-radius: 20px;
    padding: 8px 20px;
    font-weight: 600;
    font-size: 1rem;
    color: #8D5B2D;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 8px;
}
.subcategory-tab.active, .subcategory-tab:hover {
    background: #8D5B2D;
    color: #fff;
    border-color: #8D5B2D;
}

/* Product Grid */
.products-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-bottom: 32px;
}
.product-card {
    background: #fff;
    border-radius: 18px;
    border: 1.5px solid #f3e7d7;
    box-shadow: 0 4px 24px #e6a15d11;
    padding: 20px;
    display: flex;
    flex-direction: column;
    position: relative;
    min-height: 360px;
    transition: box-shadow 0.3s, transform 0.3s;
}
.product-card:hover {
    box-shadow: 0 8px 32px #e6a15d33;
    transform: translateY(-4px);
}

.product-card.hidden {
    display: none;
}

/* Product images */
.product-images {
    width: 100%;
    height: 140px;
    background: #fafafa;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
    position: relative;
    overflow: hidden;
}
.product-images img {
    max-width: 100px;
    max-height: 120px;
    object-fit: contain;
    border-radius: 8px;
}

/* Product Information */
.product-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.product-name {
    font-weight: 700;
    font-size: 1rem;
    color: #222;
    line-height: 1.3;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.product-description {
    font-size: 0.85rem;
    color: #666;
    line-height: 1.5;
    flex: 1;
}

.product-sku {
    font-family: 'Courier New', monospace;
    font-size: 0.75rem;
    color: #999;
    font-weight: 600;
}

.product-status {
    display: inline-block;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 4px 8px;
    border-radius: 10px;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    align-self: flex-start;
}

.status-available {
    background: #d4edda;
    color: #155724;
}

.status-coming-soon {
    background: #fff3cd;
    color: #856404;
}

.status-preorder {
    background: #d1ecf1;
    color: #0c5460;
}

.product-price {
    margin-top: auto;
    padding-top: 12px;
    border-top: 1px solid #f0f0f0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.price-sale {
    color: #E57300;
    font-weight: 700;
    font-size: 1rem;
}
.price-original {
    text-decoration: line-through;
    color: #aaa;
    font-size: 0.85rem;
}

@media (max-width: 1200px) {
    .products-grid { 
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    .shop-hero, 
    .category-section, 
    .search-section { 
        max-width: 100%; 
        padding: 0 24px;
    }
}

@media (max-width: 768px) {
    .search-section {
        margin-top: 0;
        padding: 0 16px;
    }
    
    .search-container {
        width: 100%;
    }
    
    .search-box {
        padding: 14px 55px 14px 50px;
    }
}

@media (max-width: 576px) {
    .shop-hero, 
    .category-section, 
    .search-section { 
        padding: 0 16px;
    }
    
    .shop-hero { 
        flex-direction: column; 
        text-align: left;
        padding: 40px 24px;
        margin-top: 100px;
    }
    
    .shop-hero-content {
        max-width: 100%;
    }
    
    .shop-hero-img { 
        position: relative; 
        right: 0;
        bottom: 0;
        margin: 20px auto 0;
        height: 280px;
        width: auto;
    }
    
    .search-section {
        margin: 10px auto 30px;
    }
    
    .search-box {
        font-size: 1rem;
        padding: 14px 50px 14px 45px;
    }
    
    .search-icon {
        left: 18px;
    }
    
    .search-clear {
        right: 15px;
    }
}
</style>

<div class="shop-hero">
    <div class="shop-hero-content">
        <h2>Pet Supplies Catalog</h2>
        <p>Find a variety of pet products at our shop, ready for you to purchase in person.</p>
    </div>
    <img src="{{ asset('images/anjingkucing.png') }}" class="shop-hero-img" alt="Dog and Cat">
</div>

<!-- Search Section -->
<div class="search-section">
    <div class="search-container">
        <i class="fas fa-search search-icon"></i>
        <input type="text" class="search-box" id="productSearch" placeholder="Search products, brands, or SKU...">
        <button class="search-clear" id="clearSearch">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<!-- No Results Message -->
<div class="no-results" id="noResults">
    <i class="fas fa-search"></i>
    <h3>No products found</h3>
    <p>Try adjusting your search terms or browse our categories below.</p>
</div>

<!-- PET FOOD Section -->
<div class="category-section" data-category="food">
    <div class="category-header">
        <div class="category-title">
            <span>🐾</span>
            PET FOOD
        </div>
    </div>
    <div class="subcategory-tabs">
        <div class="subcategory-tab active" data-target="cat-food">
            <span>🐱</span>
            Cat
        </div>
        <div class="subcategory-tab" data-target="dog-food">
            <span>🐕</span>
            Dog
        </div>
    </div>

    <!-- Cat Food Products -->
    <div class="products-grid" id="cat-food">
        @foreach([
            [
                'id'=>1,
                'img'=>'wiskas.png',
                'name'=>'WHISKAS Adult Cat Food',
                'description'=>'Makanan kucing dewasa dengan nutrisi lengkap dan seimbang. Mengandung protein tinggi untuk menjaga kesehatan dan energi kucing. Kemasan 1.2kg dengan rasa ikan, cocok untuk usia 1+ tahun.',
                'sku'=>'WHI-001',
                'status'=>'available',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>2,
                'img'=>'catcois.png',
                'name'=>'CAT CHOIZE Premium',
                'description'=>'Formula premium untuk kucing aktif. Diperkaya vitamin E dan omega-3 untuk bulu yang sehat dan berkilau. Kemasan 800g rasa ayam & sayuran untuk semua umur.',
                'sku'=>'CAT-002',
                'status'=>'available',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>3,
                'img'=>'exel.png',
                'name'=>'EXCEL Cat Nutrition',
                'description'=>'Nutrisi harian kucing dengan kandungan taurin untuk kesehatan mata dan jantung. Mudah dicerna dengan kemasan 1kg rasa salmon, cocok untuk kitten & adult.',
                'sku'=>'EXL-003',
                'status'=>'coming-soon',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>4,
                'img'=>'f1.png',
                'name'=>'FELIBITE Dry Food',
                'description'=>'Makanan kering kucing dengan teknologi advanced nutrition. Menjaga kesehatan saluran kemih kucing. Kemasan 1.5kg rasa tuna dengan pH balanced formula.',
                'sku'=>'FEL-004',
                'status'=>'preorder',
                'price'=>1000,
                'sale'=>200
            ],
        ] as $p)
        <div class="product-card"
             data-name="{{ strtolower($p['name']) }}"
             data-description="{{ strtolower($p['description']) }}"
             data-sku="{{ strtolower($p['sku']) }}">
            <div class="product-images">
                <img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['name'] }}">
            </div>
            <div class="product-info">
                <h3 class="product-name">{{ $p['name'] }}</h3>
                <p class="product-description">{{ $p['description'] }}</p>
                <div class="product-sku">SKU: {{ $p['sku'] }}</div>
                <div class="product-status status-{{ $p['status'] }}">
                    @if($p['status'] == 'available') Tersedia
                    @elseif($p['status'] == 'coming-soon') Coming Soon
                    @else Pre-order
                    @endif
                </div>
                <div class="product-price">
                    <span class="price-sale">Rp{{ number_format($p['sale'],0,',','.') }}.00</span>
                    <span class="price-original">Rp{{ number_format($p['price'],0,',','.') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Dog Food Products -->
    <div class="products-grid" id="dog-food" style="display: none;">
        @foreach([
            [
                'id'=>5,
                'img'=>'dog1.png',
                'name'=>'PEDIGREE Adult Complete',
                'description'=>'Nutrisi lengkap untuk anjing dewasa dengan protein berkualitas tinggi. Mendukung sistem imun yang kuat. Kemasan 1.5kg rasa daging sapi untuk usia 1-7 tahun.',
                'sku'=>'PED-005',
                'status'=>'available',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>6,
                'img'=>'dog2.png',
                'name'=>'DOG CHOIZE Premium',
                'description'=>'Formula premium untuk anjing aktif dan berenergi. Mengandung glukosamin untuk kesehatan sendi. Kemasan 2kg rasa ayam dengan protein 26%.',
                'sku'=>'DOG-006',
                'status'=>'available',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>7,
                'img'=>'dog3.png',
                'name'=>'SMARTHEART Gold',
                'description'=>'Makanan anjing dengan formula gold untuk pertumbuhan optimal. Diperkaya DHA untuk perkembangan otak. Kemasan 1.8kg rasa lamb & rice untuk semua breed.',
                'sku'=>'SMH-007',
                'status'=>'coming-soon',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>8,
                'img'=>'dog4.png',
                'name'=>'CANIBITE Healthy',
                'description'=>'Makanan anjing sehat dengan bahan alami pilihan. Bebas pewarna buatan dan pengawet berbahaya. Kemasan 1kg rasa ikan & sayuran dengan formula natural.',
                'sku'=>'CAN-008',
                'status'=>'preorder',
                'price'=>1000,
                'sale'=>200
            ],
        ] as $p)
        <div class="product-card"
             data-name="{{ strtolower($p['name']) }}"
             data-description="{{ strtolower($p['description']) }}"
             data-sku="{{ strtolower($p['sku']) }}">
            <div class="product-images">
                <img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['name'] }}">
            </div>
            <div class="product-info">
                <h3 class="product-name">{{ $p['name'] }}</h3>
                <p class="product-description">{{ $p['description'] }}</p>
                <div class="product-sku">SKU: {{ $p['sku'] }}</div>
                <div class="product-status status-{{ $p['status'] }}">
                    @if($p['status'] == 'available') Tersedia
                    @elseif($p['status'] == 'coming-soon') Coming Soon
                    @else Pre-order
                    @endif
                </div>
                <div class="product-price">
                    <span class="price-sale">Rp{{ number_format($p['sale'],0,',','.') }}.00</span>
                    <span class="price-original">Rp{{ number_format($p['price'],0,',','.') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- PET SUPPLIES Section -->
<div class="category-section" data-category="supplies">
    <div class="category-header">
        <div class="category-title">
            <span>🐾</span>
            PET SUPPLIES
        </div>
    </div>

    <div class="subcategory-tabs">
        <div class="subcategory-tab active" data-target="cat-supplies">
            <span>🐱</span>
            Cat
        </div>
        <div class="subcategory-tab" data-target="dog-supplies">
            <span>🐕</span>
            Dog
        </div>
    </div>

    <!-- Cat Supplies Products -->
    <div class="products-grid" id="cat-supplies">
        @foreach([
            [
                'id'=>9,
                'img'=>'scop.png',
                'name'=>'Litter Scoop Premium',
                'description'=>'Sekop pasir kucing dengan desain ergonomis dan lubang sempurna untuk menyaring pasir bersih. Material plastic ABS dengan panjang 27cm dan anti-stick coating.',
                'sku'=>'LSC-009',
                'status'=>'available',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>10,
                'img'=>'eat.png',
                'name'=>'Food Bowl Set',
                'description'=>'Set mangkuk makan dan minum kucing dengan desain anti-slip. Mudah dibersihkan dan tahan lama. Material stainless steel diameter 15cm set 2pcs.',
                'sku'=>'FBS-010',
                'status'=>'available',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>11,
                'img'=>'kan.png',
                'name'=>'Pet Carrier Cage',
                'description'=>'Kandang travel untuk kucing dengan ventilasi baik. Dilengkapi pegangan yang kuat dan nyaman. Ukuran 45x30x28cm material plastic + metal maksimal 8kg.',
                'sku'=>'PCC-011',
                'status'=>'coming-soon',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>12,
                'img'=>'main.png',
                'name'=>'Feather Toy Interactive',
                'description'=>'Mainan bulu interaktif untuk melatih refleks dan memberikan hiburan bagi kucing kesayangan. Panjang 40cm material feather + plastic warna random.',
                'sku'=>'FTI-012',
                'status'=>'available',
                'price'=>1000,
                'sale'=>200
            ],
        ] as $p)
        <div class="product-card"
             data-name="{{ strtolower($p['name']) }}"
             data-description="{{ strtolower($p['description']) }}"
             data-sku="{{ strtolower($p['sku']) }}">
            <div class="product-images">
                <img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['name'] }}">
            </div>
            <div class="product-info">
                <h3 class="product-name">{{ $p['name'] }}</h3>
                <p class="product-description">{{ $p['description'] }}</p>
                <div class="product-sku">SKU: {{ $p['sku'] }}</div>
                <div class="product-status status-{{ $p['status'] }}">
                    @if($p['status'] == 'available') Tersedia
                    @elseif($p['status'] == 'coming-soon') Coming Soon
                    @else Pre-order
                    @endif
                </div>
                <div class="product-price">
                    <span class="price-sale">Rp{{ number_format($p['sale'],0,',','.') }}.00</span>
                    <span class="price-original">Rp{{ number_format($p['price'],0,',','.') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Dog Supplies Products -->
    <div class="products-grid" id="dog-supplies" style="display: none;">
        @foreach([
            [
                'id'=>13,
                'img'=>'psr.png',
                'name'=>'Animal Sandbox Large',
                'description'=>'Kotak pasir berukuran besar untuk anjing dengan sistem drainase yang baik dan mudah dibersihkan. Ukuran 60x40x15cm material high-grade plastic dengan non-slip base.',
                'sku'=>'ASL-013',
                'status'=>'available',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>14,
                'img'=>'drink.png',
                'name'=>'Water Dispenser Auto',
                'description'=>'Dispenser air otomatis untuk anjing dengan kapasitas besar. Menjaga air selalu segar dan bersih. Kapasitas 2L material BPA-free plastic dengan auto-refill system.',
                'sku'=>'WDA-014',
                'status'=>'preorder',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>15,
                'img'=>'kuku.png',
                'name'=>'Pet Nail Clipper Pro',
                'description'=>'Gunting kuku hewan profesional dengan pisau stainless steel tajam dan pegangan anti-slip. Material stainless steel + rubber panjang 14cm dengan safety lock.',
                'sku'=>'PNC-015',
                'status'=>'available',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>16,
                'img'=>'scat.png',
                'name'=>'Cleaning Brush Set',
                'description'=>'Set sikat pembersih lengkap untuk merawat bulu anjing. Menghilangkan bulu rontok dan kotoran. Set 3pcs material natural bristle dengan handle bamboo.',
                'sku'=>'CBS-016',
                'status'=>'coming-soon',
                'price'=>1000,
                'sale'=>200
            ],
        ] as $p)
        <div class="product-card"
             data-name="{{ strtolower($p['name']) }}"
             data-description="{{ strtolower($p['description']) }}"
             data-sku="{{ strtolower($p['sku']) }}">
            <div class="product-images">
                <img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['name'] }}">
            </div>
            <div class="product-info">
                <h3 class="product-name">{{ $p['name'] }}</h3>
                <p class="product-description">{{ $p['description'] }}</p>
                <div class="product-sku">SKU: {{ $p['sku'] }}</div>
                <div class="product-status status-{{ $p['status'] }}">
                    @if($p['status'] == 'available') Tersedia
                    @elseif($p['status'] == 'coming-soon') Coming Soon
                    @else Pre-order
                    @endif
                </div>
                <div class="product-price">
                    <span class="price-sale">Rp{{ number_format($p['sale'],0,',','.') }}.00</span>
                    <span class="price-original">Rp{{ number_format($p['price'],0,',','.') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- PET VITAMINS Section -->
<div class="category-section" data-category="vitamins">
    <div class="category-header">
        <div class="category-title">
            <span>🐾</span>
            PET VITAMINS
        </div>
    </div>

    <div class="subcategory-tabs">
        <div class="subcategory-tab active" data-target="cat-vitamins">
            <span>🐱</span>
            Cat
        </div>
        <div class="subcategory-tab" data-target="dog-vitamins">
            <span>🐕</span>
            Dog
        </div>
    </div>

    <!-- Cat Vitamins Products -->
    <div class="products-grid" id="cat-vitamins">
        @foreach([
            [
                'id'=>17,
                'img'=>'fera.png',
                'name'=>'FERA PETS Multivitamin',
                'description'=>'Multivitamin lengkap untuk kucing dengan kombinasi vitamin A, D, E dan mineral penting untuk kesehatan optimal. Isi 60 tablet dosis 1 tablet/hari dengan rasa ikan.',
                'sku'=>'FPM-017',
                'status'=>'available',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>18,
                'img'=>'zesty.png',
                'name'=>'ZESTY PAWS Cat Multivitamin',
                'description'=>'Suplemen premium untuk kesehatan bulu, kulit, dan sistem imun kucing. Formula khusus dari Amerika. Isi 90 chews dosis 2 chews/hari tanpa pengawet.',
                'sku'=>'ZPC-018',
                'status'=>'available',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>19,
                'img'=>'tomlyn.png',
                'name'=>'TOMLYN Cat Immune Support',
                'description'=>'Suplemen khusus untuk meningkatkan daya tahan tubuh kucing. Mengandung probiotik dan antioksidan. Isi 30ml dosis 1ml/hari dengan formula cair.',
                'sku'=>'TCI-019',
                'status'=>'preorder',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>20,
                'img'=>'gimcat.png',
                'name'=>'GIMCAT Multivitamin Paste',
                'description'=>'Pasta multivitamin dengan rasa yang disukai kucing. Mudah diberikan dan cepat diserap tubuh. Isi 100g rasa malt dalam kemasan tube praktis.',
                'sku'=>'GMP-020',
                'status'=>'coming-soon',
                'price'=>1000,
                'sale'=>200
            ],
        ] as $p)
        <div class="product-card"
             data-name="{{ strtolower($p['name']) }}"
             data-description="{{ strtolower($p['description']) }}"
             data-sku="{{ strtolower($p['sku']) }}">
            <div class="product-images">
                <img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['name'] }}">
            </div>
            <div class="product-info">
                <h3 class="product-name">{{ $p['name'] }}</h3>
                <p class="product-description">{{ $p['description'] }}</p>
                <div class="product-sku">SKU: {{ $p['sku'] }}</div>
                <div class="product-status status-{{ $p['status'] }}">
                    @if($p['status'] == 'available') Tersedia
                    @elseif($p['status'] == 'coming-soon') Coming Soon
                    @else Pre-order
                    @endif
                </div>
                <div class="product-price">
                    <span class="price-sale">Rp{{ number_format($p['sale'],0,',','.') }}.00</span>
                    <span class="price-original">Rp{{ number_format($p['price'],0,',','.') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Dog Vitamins Products -->
    <div class="products-grid" id="dog-vitamins" style="display: none;">
        @foreach([
            [
                'id'=>21,
                'img'=>'Nutrition.png',
                'name'=>'NUTRITION STRENGTH Dog Multivitamin',
                'description'=>'Multivitamin komprehensif untuk anjing dengan formula khusus mendukung kesehatan sendi dan tulang. Isi 120 tablets dosis 2 tablet/hari untuk anjing 20kg+.',
                'sku'=>'NSD-021',
                'status'=>'available',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>22,
                'img'=>'zestydog.png',
                'name'=>'ZESTY PAWS Collagen',
                'description'=>'Suplemen kolagen untuk kesehatan kulit, bulu, dan sendi anjing. Mengandung vitamin C dan E alami. Isi 90 chews rasa bacon dengan hydrolyzed collagen.',
                'sku'=>'ZPC-022',
                'status'=>'available',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>23,
                'img'=>'multi.png',
                'name'=>'MULTIVITAMIN DOG Premium',
                'description'=>'Vitamin harian untuk anjing aktif dengan kandungan omega-3 dan 6 untuk bulu yang sehat dan berkilau. Isi 60 softgels dosis 1-2 kapsul/hari omega enriched.',
                'sku'=>'MDP-023',
                'status'=>'coming-soon',
                'price'=>1000,
                'sale'=>200
            ],
            [
                'id'=>24,
                'img'=>'ultracal.png',
                'name'=>'ULTRACAL Suplemen Vitamin',
                'description'=>'Suplemen kalsium dan vitamin D khusus untuk anjing dalam masa pertumbuhan dan anjing senior. Isi 500g powder dosis 1 sendok/hari high calcium.',
                'sku'=>'USV-024',
                'status'=>'preorder',
                'price'=>1000,
                'sale'=>200
            ],
        ] as $p)
        <div class="product-card"
             data-name="{{ strtolower($p['name']) }}"
             data-description="{{ strtolower($p['description']) }}"
             data-sku="{{ strtolower($p['sku']) }}">
            <div class="product-images">
                <img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['name'] }}">
            </div>
            <div class="product-info">
                <h3 class="product-name">{{ $p['name'] }}</h3>
                <p class="product-description">{{ $p['description'] }}</p>
                <div class="product-sku">SKU: {{ $p['sku'] }}</div>
                <div class="product-status status-{{ $p['status'] }}">
                    @if($p['status'] == 'available') Tersedia
                    @elseif($p['status'] == 'coming-soon') Coming Soon
                    @else Pre-order
                    @endif
                </div>
                <div class="product-price">
                    <span class="price-sale">Rp{{ number_format($p['sale'],0,',','.') }}.00</span>
                    <span class="price-original">Rp{{ number_format($p['price'],0,',','.') }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@include('layouts.footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchBox = document.getElementById('productSearch');
    const clearButton = document.getElementById('clearSearch');
    const noResults = document.getElementById('noResults');
    const categorySection = document.querySelectorAll('.category-section');

    // Tab functionality
    const tabs = document.querySelectorAll('.subcategory-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const parentSection = this.closest('.category-section');
            const allTabs = parentSection.querySelectorAll('.subcategory-tab');
            allTabs.forEach(t => t.classList.remove('active'));

            this.classList.add('active');

            const allGrids = parentSection.querySelectorAll('.products-grid');
            allGrids.forEach(grid => grid.style.display = 'none');

            const targetId = this.getAttribute('data-target');
            const targetGrid = parentSection.querySelector('#' + targetId);
            if (targetGrid) {
                targetGrid.style.display = 'grid';
            }
        });
    });

    // Search functionality
    searchBox.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();

        if (searchTerm.length > 0) {
            clearButton.classList.add('show');
            performSearch(searchTerm);
        } else {
            clearButton.classList.remove('show');
            clearSearch();
        }
    });

    clearButton.addEventListener('click', function() {
        searchBox.value = '';
        clearButton.classList.remove('show');
        clearSearch();
        searchBox.focus();
    });

    function performSearch(searchTerm) {
        let foundResults = false;

        // Hide all category sections first
        categorySection.forEach(section => {
            section.style.display = 'none';
        });

        // Search through all product cards
        const allProductCards = document.querySelectorAll('.product-card');
        allProductCards.forEach(card => {
            const name = card.getAttribute('data-name') || '';
            const description = card.getAttribute('data-description') || '';
            const sku = card.getAttribute('data-sku') || '';

            // Prioritas pencarian berdasarkan nama produk terlebih dahulu
            if (name.includes(searchTerm) ||
                description.includes(searchTerm) ||
                sku.includes(searchTerm)) {

                // Show the product card
                card.classList.remove('hidden');

                // Show the parent category section
                const parentSection = card.closest('.category-section');
                if (parentSection) {
                    parentSection.style.display = 'block';

                    // Show ALL products grids in this category section (both cat and dog)
                    const allGridsInSection = parentSection.querySelectorAll('.products-grid');
                    allGridsInSection.forEach(grid => {
                        // Check if this grid contains any matching products
                        const matchingCards = grid.querySelectorAll('.product-card:not(.hidden)');
                        if (matchingCards.length > 0) {
                            grid.style.display = 'grid';
                        }
                    });

                    // Hide tab functionality during search - show both cat and dog results
                    const tabs = parentSection.querySelectorAll('.subcategory-tab');
                    tabs.forEach(tab => {
                        tab.style.pointerEvents = 'none';
                        tab.style.opacity = '0.6';
                    });
                }

                foundResults = true;
            } else {
                card.classList.add('hidden');
            }
        });

        // After hiding non-matching cards, show all grids that have visible cards
        categorySection.forEach(section => {
            if (section.style.display === 'block') {
                const allGrids = section.querySelectorAll('.products-grid');
                allGrids.forEach(grid => {
                    const visibleCards = grid.querySelectorAll('.product-card:not(.hidden)');
                    if (visibleCards.length > 0) {
                        grid.style.display = 'grid';
                    } else {
                        grid.style.display = 'none';
                    }
                });
            }
        });

        // Show/hide no results message
        if (!foundResults) {
            noResults.style.display = 'block';
        } else {
            noResults.style.display = 'none';
        }
    }

    function clearSearch() {
        // Show all category sections
        categorySection.forEach(section => {
            section.style.display = 'block';
        });

        // Show all product cards
        const allProductCards = document.querySelectorAll('.product-card');
        allProductCards.forEach(card => {
            card.classList.remove('hidden');
        });

        // Hide no results message
        noResults.style.display = 'none';

        // Re-enable tab functionality
        const allTabs = document.querySelectorAll('.subcategory-tab');
        allTabs.forEach(tab => {
            tab.style.pointerEvents = 'auto';
            tab.style.opacity = '1';
        });

        // Reset tab functionality - show active tabs only
        const allSections = document.querySelectorAll('.category-section');
        allSections.forEach(section => {
            const activeTab = section.querySelector('.subcategory-tab.active');
            const allGrids = section.querySelectorAll('.products-grid');

            allGrids.forEach(grid => {
                grid.style.display = 'none';
            });

            if (activeTab) {
                const targetId = activeTab.getAttribute('data-target');
                const targetGrid = section.querySelector('#' + targetId);
                if (targetGrid) {
                    targetGrid.style.display = 'grid';
                }
            }
        });
    }

    // Handle Enter key
    searchBox.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            this.blur();
        }
    });
});
</script>

@endsection
            
