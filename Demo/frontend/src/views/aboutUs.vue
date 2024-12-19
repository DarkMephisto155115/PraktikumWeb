<template>
    <div class="container-fluid bg-dark text-light py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">About TERRA-BRAIN STORE</h1>
                <div class="card bg-secondary mb-4">
                    <div class="card-body">
                        <h2 class="card-title h4 mb-3">Our Story</h2>
                        <p>Berdiri sejak tahun 2002, TERRA-BRAIN STORE telah 22 tahun melayani<br></p>
                        <p><span style="color: #ff0000;"><strong>What Make Us Survive n keep growing?</strong></span>
                        </p>
                        <p><em>Competent, Brotherhood, Fun, and Hardwork to create the real Customer
                                Satisfaction<br></em></p>
                        <p>22 tahun bukanlah masa singkat, tanpa formula khusus kami tidak akan berhasil melewatinya.
                            Pelayanan Customer yang prima tentu menjadi salah satu kunci utama untuk membangun bisnis
                            jangka panjang. Namun bagi kami, pelayanan itu hampir mustahil dihadirkan dari 'jiwa-jiwa
                            yang sakit' <em>. </em>Demikian juga ketika menghadapi masa-masa sulit, ketahanan tinggi
                            untuk melewatinya adalah mustahil tanpa 'sandaran' yang tepat.</p>
                        <p>Kami percaya bahwa ketahanan bisnis jangka panjang harus diwujudkan mulai dari kesehatan
                            internal. Kami juga yakin bahwa pelayanan yang terbaik hanya bisa dilahirkan dari pribadi
                            yang waras. Karenanya, sungguh-sungguh kami junjung tinggi nilai-nilai pusaka -
                            <em>Competent, Brotherhood, Fun, and Hardwork</em></p>
                        <p>&nbsp;</p>
                    </div>
                </div>
                <div class="card bg-secondary mb-4">
                    <div class="card-body">
                        <h2 class="card-title h4 mb-3">Our Values</h2>
                        <ul class="list-group list-group-flush bg-transparent">
                            <li class="list-group-item bg-transparent text-light">Customer First: Your satisfaction is
                                our top priority.</li>
                            <li class="list-group-item bg-transparent text-light">Quality: We only sell products that
                                meet our high standards.</li>
                            <li class="list-group-item bg-transparent text-light">Integrity: We believe in honest and
                                transparent business practices.</li>
                            <li class="list-group-item bg-transparent text-light">Innovation: We're always looking for
                                new ways to improve your shopping experience.</li>
                        </ul>
                    </div>
                </div>
                <div class="card bg-secondary">
                    <div class="card-body">
                        <h2 class="card-title h4 mb-3">Meet Our Team</h2>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card bg-dark">
                                    <img src="./../assets/Administrator-portrait.webp" class="card-img-top" alt="CEO">
                                    <div class="card-body">
                                        <h5 class="redacted card-title text-light"> The <em style="color: black;">██████</em></h5>
                                        <p class="card-text text-light">Supreme Administator</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card bg-dark">
                                    <img src="./../assets/AdminFailure_Terrabrain_Boot.jpg" class="card-img-top" alt="CTO">
                                    <div class="card-body">
                                        <h5 class="card-title text-light">Terra Brain</h5>
                                        <p class="card-text text-light">Interdimensional Super Computer</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card bg-dark">
                                    <img src="./../assets/image.png" class="card-img-top" alt="COO">
                                    <div class="card-body">
                                        <h5 class="card-title text-light">G.A.P/ Sigma type series</h5>
                                        <p class="card-text text-light"> Head of Future Strategy Department</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AboutUs'
}
</script>

<style scoped>
.redacted {
    white-space: nowrap;
}

/* Add a few more selectors with slightly varying styles */
.redacted:first-child {
    transform: rotate(-.8deg); /* Use standard 'transform' */
}

.redacted:first-child + .redacted {
    transform: rotate(3deg); /* Use standard 'transform' */
}

/* "Highlighter" effect */
.redacted::selection { /* Use standard '::selection' */
    background: #e6ff3f;
}

</style>