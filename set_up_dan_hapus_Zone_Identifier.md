Berikut adalah langkah-langkah lengkap untuk mempersiapkan lingkungan pemrograman Python dan C++ di Windows dengan menggunakan WSL (Windows Subsystem for Linux) dan Zsh (Z shell):

1. **Buka PowerShell sebagai Administrator:**
    - Klik kanan pada ikon PowerShell dan pilih "Run as administrator".

2. **Update WSL:**
    - Ketikkan perintah berikut di PowerShell:
      ```sh
      wsl --update
      ```
    - Tunggu hingga proses selesai.

3. **Setel pengguna default Ubuntu ke root:**
    - Ketikkan perintah berikut:
      ```sh
      Ubuntu config --default-user root
      ```

4. **Buka Terminal dan Pilih Ubuntu:**
    - Ketikkan perintah berikut untuk menginstal Zsh:
      ```sh
      apt install zsh -y
      ```
      
5. **Instal Oh My Zsh:**
    - Ketikkan perintah berikut:
      ```sh
      sh -c "$(curl -fsSL https://raw.githubusercontent.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"
      ```

6. **Klarifikasi Terminal:**
    - Ketikkan:
      ```sh
      clear
      ```

7. **Instal Plugin Zsh:**
    - Ketikkan perintah berikut untuk menginstal zsh-autosuggestions:
      ```sh
      git clone https://github.com/zsh-users/zsh-autosuggestions.git $ZSH_CUSTOM/plugins/zsh-autosuggestions
      ```
    - Ketikkan perintah berikut untuk menginstal zsh-syntax-highlighting:
      ```sh
      git clone https://github.com/zsh-users/zsh-syntax-highlighting.git $ZSH_CUSTOM/plugins/zsh-syntax-highlighting
      ```

8. **Edit Konfigurasi Zsh:**
    - Ketikkan:
      ```sh
      nano /root/.zshrc
      ```
    - Tekan `Ctrl + W`, ketik `plugins`, dan tekan `Enter`. 
    - Tambahkan plugin seperti berikut:
      ```sh
      plugins=(git zsh-autosuggestions zsh-syntax-highlighting)
      ```
    - Tekan `Ctrl + X`, lalu `Y`, kemudian `Enter`.

9. **Sumber Ulang Konfigurasi Zsh:**
    - Ketikkan:
      ```sh
      source /root/.zshrc
      ```

10. **Siapkan SSH Key untuk GitHub:**
    - Buka browser dan masuk ke akun GitHub masing-masing.
    - Navigasikan ke `Settings` -> `SSH and GPG keys` -> `New SSH key`.
    - Kembali ke terminal Ubuntu dan ketikkan:
      ```sh
      ssh-keygen
      ```
    - Tekan `Enter` untuk semua prompt.
    - Ketikkan perintah berikut untuk menampilkan kunci SSH:
      ```sh
      cat /root/.ssh/id_rsa.pub
      ```
    - Salin semua output dan tambahkan ke GitHub sebagai SSH key baru.

11. **Buat Repository Baru di GitHub dan Persiapkan Direktori Lokal:**
    - Buat repository baru di GitHub.
    - Kembali ke terminal Ubuntu dan ketikkan:
      ```sh
      mkdir bp
      cd bp
      mkdir pert1
      touch Readme.md
      code .
      ```
      
12. **Inisialisasi Git:**
    - Di terminal, ketikkan:
      ```sh
      git init
      git add .
      git commit -m "test"
      git branch -M main
      git remote add origin [URL SSH dari repository GitHub]
      git push -u origin main
      ```

13. **Instal Compiler untuk C++:**
    - Ketikkan:
      ```sh
      apt install g++ gcc -y
      ```

14. **Buat File C++ dan Python:**
    - Buat file `test.cpp` di folder `pert1` dengan isi berikut:
      ```cpp
      #include <iostream>
      using namespace std;

      int main(){
          cout << "hello";
          return 0;
      }
      ```
    - Buat file `python.py` di folder `pert1` dengan isi berikut:
      ```python
      a = 1
      b = 2
      c = a + b
      print(c)
      ```

15. **Kompilasi dan Jalankan File C++:**
    - Di terminal Ubuntu, ketikkan:
      ```sh
      gcc test.cpp -o test
      ./test
      ```

16. **Jalankan File Python:**
    - Ketikkan:
      ```sh
      python3 python.py
      ```

17. **Push Perubahan ke GitHub:**
    - Di terminal Ubuntu, ketikkan:
      ```sh
      cd bp/pert1
      git add .
      git commit -m "perubahan"
      git push -u origin main
      ```

Langkah-langkah di atas akan membantu Anda dalam menyiapkan lingkungan pemrograman yang kuat dan efisien di sistem Windows menggunakan WSL, Zsh, dan GitHub.

# Cara Hapus zone Identyfier
Di dalam terminal ketikkan
```
 find . -type f -name '*:Zone.Identifier*' -exec rm -f {} \;
 ```