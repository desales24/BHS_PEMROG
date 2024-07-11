Menghapus commit yang sudah dibuat bisa dilakukan dengan beberapa cara tergantung pada situasi dan apakah commit tersebut sudah dipush ke remote atau belum. Berikut adalah cara-cara untuk menghapus commit yang sudah dibuat:

### 1. Menghapus Commit yang Belum Dipush ke Remote

#### Menggunakan `git reset`

`git reset` memungkinkan Anda untuk menghapus commit dari riwayat lokal.

##### Menghapus Commit Terakhir
```bash
git reset --hard HEAD~1
```

##### Menghapus Beberapa Commit Terakhir
Gantilah angka `n` dengan jumlah commit yang ingin dihapus.
```bash
git reset --hard HEAD~n
```

**Catatan:** Perintah `--hard` akan menghapus perubahan yang dibuat oleh commit tersebut dari working directory. Jika Anda ingin mempertahankan perubahan di working directory, gunakan `--soft` atau `--mixed`:
- `--soft`: Mempertahankan perubahan dalam indeks (staging area).
- `--mixed`: Mempertahankan perubahan di working directory, tapi menghapus dari indeks.

```bash
git reset --soft HEAD~1
```

### 2. Menghapus Commit yang Sudah Dipush ke Remote

Jika commit sudah dipush ke remote, Anda perlu lebih berhati-hati karena ini dapat mempengaruhi kolaborator lain.

#### Menggunakan `git revert`
`git revert` membuat commit baru yang membatalkan perubahan commit tertentu tanpa mengubah riwayat commit.

##### Membatalkan Commit Terakhir
```bash
git revert HEAD
```

##### Membatalkan Commit Tertentu
```bash
git revert <commit_id>
```

#### Menggunakan `git reset` dan `git push --force`
Ini akan mengubah riwayat commit dan harus digunakan dengan sangat hati-hati.

##### Langkah-langkah:
1. **Reset ke Commit Sebelumnya**
   ```bash
   git reset --hard HEAD~1
   ```

2. **Push dengan `--force`**
   ```bash
   git push --force
   ```

### Contoh Penggunaan

#### Contoh: Menghapus Commit Terakhir yang Belum Dipush

1. **Lihat Riwayat Commit**
   ```bash
   git log
   ```

2. **Reset ke Commit Sebelumnya**
   ```bash
   git reset --hard HEAD~1
   ```

#### Contoh: Menghapus Commit Terakhir yang Sudah Dipush (Menggunakan `git revert`)

1. **Lihat Riwayat Commit**
   ```bash
   git log
   ```

2. **Revert Commit Terakhir**
   ```bash
   git revert HEAD
   ```

3. **Push Perubahan ke Remote**
   ```bash
   git push
   ```

#### Contoh: Menghapus Commit Terakhir yang Sudah Dipush (Menggunakan `git reset` dan `git push --force`)

1. **Lihat Riwayat Commit**
   ```bash
   git log
   ```

2. **Reset ke Commit Sebelumnya**
   ```bash
   git reset --hard HEAD~1
   ```

3. **Push dengan `--force`**
   ```bash
   git push --force
   ```

### Tips Tambahan
- **Gunakan `git reset --hard` dengan hati-hati** karena ini akan menghapus perubahan yang belum di-commit di working directory Anda.
- **Gunakan `git push --force` dengan sangat hati-hati** terutama pada cabang yang dibagikan dengan orang lain karena dapat menyebabkan masalah sinkronisasi bagi kolaborator.
- **Pertimbangkan menggunakan `git revert`** jika Anda tidak ingin mengubah riwayat commit, karena ini adalah cara yang lebih aman.

Dengan langkah-langkah di atas, Anda dapat menghapus commit yang tidak diinginkan sesuai dengan kebutuhan Anda, baik itu commit yang belum dipush ke remote maupun yang sudah dipush.