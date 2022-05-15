
#def ulang ():

#import Pytelegrambotapi
import telebot
import mysql.connector


mydb = mysql.connector.connect(
    host = 'localhost',
    user = 'root',
    passwd = '',
    database = 'stockbarang'
)

#cek
print(mydb)


#memberi input SQL
sql = mydb.cursor()
sqlkeluar = mydb.cursor()
sqlstock = mydb.cursor()

api = '1703543161:AAGUeskIJOUBu7RZJ6Vf_hIubbTd7Akzm3M'
bot = telebot.TeleBot(api)

@bot.message_handler(commands=['mulai'])
def send_pesan(message):
    bot.reply_to(message,'Halo ini bot barang!')

@bot.message_handler(commands=['help'])
def send_pesan(message):
    bot.reply_to(message,'Kontak Admin WA : 082154297889')

@bot.message_handler(commands=['menu'])
def send_pesan(message):
    bot.reply_to(message,'silahkan pilih menu dibawah')
    bot.reply_to(message,'/stok = untuk menampilkan stok barang')
    bot.reply_to(message,'/stok_masuk = untuk menampilkan stok barang masuk')
    bot.reply_to(message,'/stok_keluar = untuk menampilkan stok barang keluar')

@bot.message_handler(commands=['stock'])
def stock_keluar(message):
    #split message
    texts = message.text.split(' ')
    print(texts)
    
    sqlstock.execute("select CONCAT_WS('',namabarang,' |',' [', stock,']') from stock ORDER BY namabarang ASC")
    
    hasil_sqlstock = sqlstock.fetchall()
    print(hasil_sqlstock)

    #pesan yg dikirimkan oleh bot
    pesan_balasan = '---------------------------------------'
    for x in hasil_sqlstock:
        pesan_balasan = pesan_balasan + str(x) + '\n'
        pesan_balasan = pesan_balasan.replace("'","")
        pesan_balasan = pesan_balasan.replace("(","")
        pesan_balasan = pesan_balasan.replace(")","")
        pesan_balasan = pesan_balasan.replace(",","")
        pesan_balasan = pesan_balasan.replace("datetime.date","")
    bot.reply_to(message, pesan_balasan)


@bot.message_handler(commands=['masuk'])
def stock_masuk(message):
    #split message
    texts = message.text.split(' ')
    print(texts)
    
    sql.execute("select CONCAT_WS('',namabarang,' | ', tanggal,' | [', qty,']') from stock INNER JOIN masuk ON stock.idbarang=masuk.idbarang ORDER BY  tanggal DESC")
    #sql.execute("select idbarang, tanggal, qty from masuk")
    hasil_sql = sql.fetchall()
    print(hasil_sql)

    #pesan yg dikirimkan oleh bot
    pesan_balasan = '---------------------------------------'
    for x in hasil_sql:
        pesan_balasan = pesan_balasan + str(x) + '\n'
        pesan_balasan = pesan_balasan.replace("'","")
        pesan_balasan = pesan_balasan.replace("(","")
        pesan_balasan = pesan_balasan.replace(")","")
        pesan_balasan = pesan_balasan.replace(",","")
        pesan_balasan = pesan_balasan.replace("datetime.date","")
    bot.reply_to(message, pesan_balasan)

@bot.message_handler(commands=['keluar'])
def stock_keluar(message):
    #split message
    texts = message.text.split(' ')
    print(texts)
    
    sqlkeluar.execute("select CONCAT_WS('',namabarang,' | ', tanggal,' | [', qty,']') from stock INNER JOIN keluar ON stock.idbarang=keluar.idbarang ORDER BY tanggal DESC")
    
    hasil_sqlkeluar = sqlkeluar.fetchall()
    print(hasil_sqlkeluar)

    #pesan yg dikirimkan oleh bot
    pesan_balasan = '---------------------------------------'
    for x in hasil_sqlkeluar:
        pesan_balasan = pesan_balasan + str(x) + '\n'
        pesan_balasan = pesan_balasan.replace("'","")
        pesan_balasan = pesan_balasan.replace("(","")
        pesan_balasan = pesan_balasan.replace(")","")
        pesan_balasan = pesan_balasan.replace(",","")
        pesan_balasan = pesan_balasan.replace("datetime.date","")
    bot.reply_to(message, pesan_balasan)






print('bot start running')
bot.polling()