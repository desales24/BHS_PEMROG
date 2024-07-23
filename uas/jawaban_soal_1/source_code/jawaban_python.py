def faktorial(n):
    if n == 1:  # Base case
        return 1
    else:
        return n * faktorial(n - 1)  # Rekurens

# Contoh penggunaan
print(faktorial(5))  # Output: 120
