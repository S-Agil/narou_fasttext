import sys
import MeCab
import fasttext as ft

obj = sys.argv[1]
tagger = MeCab.Tagger('-Owakati')
words = tagger.parse(obj)
print('\n', words)

classifier = ft.load_model('tensei.bin')
estimate_2 = classifier.predict_proba([words], k=2)
if estimate_2[0][0][0] == "__label__1,":
    print('流行る！')
else:
    print('流行らない')

print(estimate_2)