import sys

# 1. S-Box (Tabel Substitusi Standar AES)
s_box = (
    0x63, 0x7C, 0x77, 0x7B, 0xF2, 0x6B, 0x6F, 0xC5, 0x30, 0x01, 0x67, 0x2B, 0xFE, 0xD7, 0xAB, 0x76,
    0xCA, 0x82, 0xC9, 0x7D, 0xFA, 0x59, 0x47, 0xF0, 0xAD, 0xD4, 0xA2, 0xAF, 0x9C, 0xA4, 0x72, 0xC0,
    0xB7, 0xFD, 0x93, 0x26, 0x36, 0x3F, 0xF7, 0xCC, 0x34, 0xA5, 0xE5, 0xF1, 0x71, 0xD8, 0x31, 0x15,
    0x04, 0xC7, 0x23, 0xC3, 0x18, 0x96, 0x05, 0x9A, 0x07, 0x12, 0x80, 0xE2, 0xEB, 0x27, 0xB2, 0x75,
    0x09, 0x83, 0x2C, 0x1A, 0x1B, 0x6E, 0x5A, 0xA0, 0x52, 0x3B, 0xD6, 0xB3, 0x29, 0xE3, 0x2F, 0x84,
    0x53, 0xD1, 0x00, 0xED, 0x20, 0xFC, 0xB1, 0x5B, 0x6A, 0xCB, 0xBE, 0x39, 0x4A, 0x4C, 0x58, 0xCF,
    0xD0, 0xEF, 0xAA, 0xFB, 0x43, 0x4D, 0x33, 0x85, 0x45, 0xF9, 0x02, 0x7F, 0x50, 0x3C, 0x9F, 0xA8,
    0x51, 0xA3, 0x40, 0x8F, 0x92, 0x9D, 0x38, 0xF5, 0xBC, 0xB6, 0xDA, 0x21, 0x10, 0xFF, 0xF3, 0xD2,
    0xCD, 0x0C, 0x13, 0xEC, 0x5F, 0x97, 0x44, 0x17, 0xC4, 0xA7, 0x7E, 0x3D, 0x64, 0x5D, 0x19, 0x73,
    0x60, 0x81, 0x4F, 0xDC, 0x22, 0x2A, 0x90, 0x88, 0x46, 0xEE, 0xB8, 0x14, 0xDE, 0x5E, 0x0B, 0xDB,
    0xE0, 0x32, 0x3A, 0x0A, 0x49, 0x06, 0x24, 0x5C, 0xC2, 0xD3, 0xAC, 0x62, 0x91, 0x95, 0xE4, 0x79,
    0xE7, 0xC8, 0x37, 0x6D, 0x8D, 0xD5, 0x4E, 0xA9, 0x6C, 0x56, 0xF4, 0xEA, 0x65, 0x7A, 0xAE, 0x08,
    0xBA, 0x78, 0x25, 0x2E, 0x1C, 0xA6, 0xB4, 0xC6, 0xE8, 0xDD, 0x74, 0x1F, 0x4B, 0xBD, 0x8B, 0x8A,
    0x70, 0x3E, 0xB5, 0x66, 0x48, 0x03, 0xF6, 0x0E, 0x61, 0x35, 0x57, 0xB9, 0x86, 0xC1, 0x1D, 0x9E,
    0xE1, 0xF8, 0x98, 0x11, 0x69, 0xD9, 0x8E, 0x94, 0x9B, 0x1E, 0x87, 0xE9, 0xCE, 0x55, 0x28, 0xDF,
    0x8C, 0xA1, 0x89, 0x0D, 0xBF, 0xE6, 0x42, 0x68, 0x41, 0x99, 0x2D, 0x0F, 0xB0, 0x54, 0xBB, 0x16,
)

# Konstanta Rcon (untuk Key Expansion)
Rcon = (
    0x00, 0x01, 0x02, 0x04, 0x08, 0x10, 0x20, 0x40,
    0x80, 0x1B, 0x36, 0x6C, 0xD8, 0xAB, 0x4D, 0x9A,
    0x2F, 0x5E, 0xBC, 0x63, 0xC6, 0x97, 0x35, 0x6A,
    0xD4, 0xB3, 0x7D, 0xFA, 0xEF, 0xC5, 0x91, 0x39,
)

# --- Fungsi Pembantu ---
def text2matrix(text):
    """Mengubah string/bytes menjadi matriks State 4x4"""
    matrix = []
    for i in range(16):
        byte = (text >> (8 * (15 - i))) & 0xFF
        if i % 4 == 0:
            matrix.append([byte])
        else:
            matrix[i // 4].append(byte)
    return matrix

def matrix2text(matrix):
    """Mengubah matriks kembali menjadi angka heksadesimal"""
    text = 0
    for i in range(4):
        for j in range(4):
            text |= (matrix[i][j] << (120 - 8 * (4 * i + j)))
    return text

# --- TRANSFORMATION 1: SubBytes ---
def sub_bytes(s):
    for i in range(4):
        for j in range(4):
            # Mengganti nilai berdasarkan tabel s_box
            s[i][j] = s_box[s[i][j]]

# --- TRANSFORMATION 2: ShiftRows ---
def shift_rows(s):
    # Baris 1 geser 1, Baris 2 geser 2, Baris 3 geser 3
    s[1][0], s[1][1], s[1][2], s[1][3] = s[1][1], s[1][2], s[1][3], s[1][0]
    s[2][0], s[2][1], s[2][2], s[2][3] = s[2][2], s[2][3], s[2][0], s[2][1]
    s[3][0], s[3][1], s[3][2], s[3][3] = s[3][3], s[3][0], s[3][1], s[3][2]

# --- TRANSFORMATION 3: AddRoundKey ---
def add_round_key(s, k):
    for i in range(4):
        for j in range(4):
            # Melakukan operasi XOR
            s[i][j] ^= k[i][j]

# --- TRANSFORMATION 4: MixColumns ---
# Ini bagian tersulit (Matematika Galois Field).
# Fungsi gmul ini melakukan perkalian khusus dalam GF(2^8).
def gmul(a, b):
    p = 0
    for counter in range(8):
        if (b & 1) != 0:
            p ^= a
        hi_bit_set = (a & 0x80) != 0
        a <<= 1
        if hi_bit_set:
            a ^= 0x1B # Angka ajaib Galois Field
        b >>= 1
    return p & 0xFF

def mix_columns(s):
    for i in range(4): # Iterasi per kolom
        # Kita ambil kolom ke-i
        c0 = s[0][i]
        c1 = s[1][i]
        c2 = s[2][i]
        c3 = s[3][i]

        # Matriks perkalian standar AES
        s[0][i] = gmul(c0, 2) ^ gmul(c1, 3) ^ gmul(c2, 1) ^ gmul(c3, 1)
        s[1][i] = gmul(c0, 1) ^ gmul(c1, 2) ^ gmul(c2, 3) ^ gmul(c3, 1)
        s[2][i] = gmul(c0, 1) ^ gmul(c1, 1) ^ gmul(c2, 2) ^ gmul(c3, 3)
        s[3][i] = gmul(c0, 3) ^ gmul(c1, 1) ^ gmul(c2, 1) ^ gmul(c3, 2)

def key_expansion(key):
    # Mengubah kunci 128-bit menjadi list of bytes
    key_symbols = [((key >> (8 * (15 - i))) & 0xFF) for i in range(16)]

    # Kita butuh 44 word (32-bit) untuk 11 ronde (4 word per ronde)
    w = [0] * 44

    # 4 word pertama adalah kunci asli
    for i in range(4):
        w[i] = (key_symbols[4*i] << 24) | (key_symbols[4*i+1] << 16) | \
               (key_symbols[4*i+2] << 8) | key_symbols[4*i+3]

    # Loop untuk generate sisa kunci
    for i in range(4, 44):
        temp = w[i-1]
        if i % 4 == 0:
            # Rotasi byte, SubBytes, lalu XOR dengan Rcon
            rot = ((temp << 8) & 0xFFFFFF00) | ((temp >> 24) & 0xFF)
            sub = (s_box[(rot >> 24) & 0xFF] << 24) | \
                  (s_box[(rot >> 16) & 0xFF] << 16) | \
                  (s_box[(rot >> 8) & 0xFF] << 8) | \
                  (s_box[rot & 0xFF])
            temp = sub ^ (Rcon[i // 4] << 24)

        w[i] = w[i-4] ^ temp

    # Ubah kembali format menjadi matriks state 4x4 untuk setiap ronde
    round_keys = []
    for i in range(11): # 0 sampai 10
        round_matrix = [[0]*4 for _ in range(4)]
        for col in range(4):
            word = w[4*i + col]
            for row in range(4):
                round_matrix[row][col] = (word >> (24 - 8*row)) & 0xFF
        round_keys.append(round_matrix)

    return round_keys

def encrypt(plaintext, key):
    # 1. Siapkan State dan Key
    state = text2matrix(plaintext)
    round_keys = key_expansion(key)

    # 2. Initial Round (Cuma AddRoundKey)
    add_round_key(state, round_keys[0])

    # 3. Main Rounds (Ronde 1 sampai 9)
    for i in range(1, 10):
        sub_bytes(state)
        shift_rows(state)
        mix_columns(state)
        add_round_key(state, round_keys[i])

    # 4. Final Round (Ronde 10 - Tanpa MixColumns)
    sub_bytes(state)
    shift_rows(state)
    add_round_key(state, round_keys[10])

    return matrix2text(state)

def prepare_input(text):
    """
    Fungsi untuk memastikan input user menjadi tepat 16 byte (128-bit).
    - Jika kurang dari 16 karakter: Tambahkan padding (byte kosong \0).
    - Jika lebih dari 16 karakter: Potong (truncate) ambil 16 pertama.
    """
    # 1. Ubah string ke bytes (encode utf-8)
    data = text.encode('utf-8')

    # 2. Cek panjang data
    if len(data) < 16:
        # Padding: Tambahkan byte null (\x00) sampai panjangnya 16
        data = data.ljust(16, b'\0')
        print(f"[Info] Input '{text}' kurang dari 16 byte. Padding ditambahkan.")
    elif len(data) > 16:
        # Truncate: Potong dan ambil 16 byte pertama saja
        data = data[:16]
        print(f"[Info] Input '{text}' lebih dari 16 byte. Data dipotong.")

    # 3. Ubah bytes menjadi satu angka integer besar (sesuai format kode kita sebelumnya)
    return int.from_bytes(data, byteorder='big')

def int_to_string(number):
    """Mengubah kembali integer hasil enkripsi menjadi string hex supaya bisa dibaca"""
    # Kita format menjadi hexadesimal, hilangkan '0x' di depan
    return hex(number)[2:]

if __name__ == "__main__":
    # Kita butuh 2 argumen: [1] Nama Script, [2] Key, [3] Plaintext
    if len(sys.argv) < 3:
        print("Error: Butuh Key dan Plaintext")
        sys.exit(1)

    input_key = sys.argv[1]       # Kunci dikirim dari PHP
    input_msg = sys.argv[2]       # Nama Pelanggan dikirim dari PHP

    # Proses standarisasi input (sama seperti kodemu)
    plaintext_int = prepare_input(input_msg)
    key_int       = prepare_input(input_key)

    try:
        # Jalankan Enkripsi
        ciphertext_int = encrypt(plaintext_int, key_int)

        # HANYA print hasil Hex-nya saja agar bisa dibaca PHP
        # Hilangkan semua print lain (seperti "Masukkan Pesan", dll)
        print(hex(ciphertext_int)[2:])

    except Exception as e:
        print("Error")



