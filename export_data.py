import mysql.connector

# 1. Koneksi ke Database
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="laundry_db"
)

cursor = mydb.cursor()

# 2. Ambil data menggunakan VIEW (Memanfaatkan fitur View DB)
cursor.execute("SELECT * FROM list_aktif")
results = cursor.fetchall()

# 3. Tulis ke file text
with open("laporan_laundry.txt", "w") as f:
    f.write("LAPORAN STATUS LAUNDRY AKTIF\n")
    f.write("============================\n")
    for row in results:
        # row[1] = nama, row[2] = status
        f.write(f"Pelanggan: {row[1]} | Status: {row[2]} | Tagihan: {row[3]}\n")

print("Sukses export data")