#!/Users/hourianalthunayangmail.com/opt/anaconda3/bin/python
# -- coding: utf-8 --

import sys
import pandas as pd
from sklearn.metrics import classification_report
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.svm import SVC
from matplotlib import pyplot as plt
from sklearn.feature_extraction.text import CountVectorizer
import numpy as np
from nltk.corpus import stopwords
from nltk.stem import WordNetLemmatizer
from sklearn.model_selection import train_test_split 
import string

newId = sys.argv[1]
# newId= '641d92bd6d5867ca380685d2feedback'
file ='/Applications/MAMP/htdocs/2_ToxicityInspector_App/Uploads/'+newId+'.csv'
file = pd.read_csv(file)
# read training and testing data after splitting
X=file['comment_text']
y=file['toxic']
X_train, X_test, y_train, y_test = train_test_split(X,y,stratify=y,test_size=0.2)

y_testDF = pd.DataFrame(y_test)
yCount_test= y_testDF.shape[0]
y_trainDF = pd.DataFrame(y_train)
yCount_train = y_trainDF.shape[0]
X_trainDF = pd.DataFrame(X_train)
X_testDF = pd.DataFrame(X_test)

X_testDF = X_testDF.reset_index(drop=True)
X_trainDF = X_trainDF.reset_index(drop=True)
y_testDF = y_testDF.reset_index(drop=True)
y_trainDF = y_trainDF.reset_index(drop=True)

new_CSV_file='/Applications/MAMP/htdocs/2_ToxicityInspector_App/Uploads/'+newId+'test.csv'
file_new= open(new_CSV_file,'w')
new_test_df = pd.read_csv(new_CSV_file,names=['comment_text','toxic'])
index=0    
for y in range(yCount_test):
        comment =X_testDF.at[index,'comment_text']
        new_test_df.loc[index,'comment_text'] = comment
        new_test_df.loc[index,'toxic'] = y_testDF.at[index,'toxic']
        index=index+1
new_test_df.to_csv(new_CSV_file) 
file_new.close() #save test file 

new_CSV_file1='/Applications/MAMP/htdocs/2_ToxicityInspector_App/Uploads/'+newId+'train.csv'
file_new= open(new_CSV_file1,'w')
new_train_df = pd.read_csv(new_CSV_file1,names=['comment_text','toxic'])
index=0    
for index in range(yCount_train):
        comment =X_trainDF.at[index,'comment_text']
        new_train_df.loc[index,'comment_text'] = comment
        new_train_df.loc[index,'toxic'] = y_trainDF.at[index,'toxic']
        index=index+1

new_train_df.to_csv(new_CSV_file1) 
file_new.close()

train ='/Applications/MAMP/htdocs/2_ToxicityInspector_App/Uploads/'+newId+'train.csv'
train = pd.read_csv(train)
test ='/Applications/MAMP/htdocs/2_ToxicityInspector_App/Uploads/'+newId+'test.csv'
test = pd.read_csv(test)

# convert the test and train data into dataframe and reset indexes 
train= pd.DataFrame(train)
train.reset_index(drop=True)
test= pd.DataFrame(test)
test.reset_index(drop=True)

train['comment_text'] = train['comment_text'].str.lower()
test['comment_text'] = test['comment_text'].str.lower()

punctuations_list = string.punctuation
def remove_punctuations(text):
    temp = str.maketrans('', '', punctuations_list)
    return text.translate(temp)

train['comment_text'] = train['comment_text'].apply(lambda x: remove_punctuations(x))
test['comment_text'] = test['comment_text'].apply(lambda x: remove_punctuations(x))

def remove_stopwords(text):
    stop_words = stopwords.words('english')
 
    imp_words = []

    # Storing the important words
    for word in str(text).split():
 
        if word not in stop_words:
 
            # Let's Lemmatize the word as well
            # before appending to the imp_words list.
            lemmatizer = WordNetLemmatizer()
            lemmatizer.lemmatize(word)
 
            imp_words.append(word)
 
    output = " ".join(imp_words)
 
    return output

train['comment_text'] = train['comment_text'].apply(lambda text: remove_stopwords(text))
test['comment_text'] = test['comment_text'].apply(lambda text: remove_stopwords(text))

tfidf_vc = TfidfVectorizer(analyzer = "word", ngram_range = (1, 2), stop_words = 'english', lowercase = True)
train_vc = tfidf_vc.fit_transform(train['comment_text'])
val_vc = tfidf_vc.transform(test['comment_text'])

# create a linear svm model
model = SVC(kernel='linear' ,class_weight='balanced',probability=True)
model = model.fit(train_vc, train.toxic)

val_pred = model.predict(val_vc)
report = classification_report(test.toxic, val_pred , output_dict=True)

comment_text = train.comment_text
raw_data = comment_text.values.tolist()

vectorizer = CountVectorizer()
X = vectorizer.fit_transform(raw_data)

comment_text = train.comment_text
toxicity_labels = train.toxic
raw_data = comment_text.values.tolist()
y = np.array(toxicity_labels.values)

vectorizer = CountVectorizer()
X = vectorizer.fit_transform(raw_data)

svm = SVC(kernel='linear',class_weight='balanced',probability=True)
svm.fit(X, y)
coefs = svm.coef_.toarray().flatten()
words = vectorizer.get_feature_names_out()
coefs, words = zip(*sorted(zip(coefs, words), key=lambda x: x[0], reverse=True)[:200000])
coefs_nontoxic, words_nontoxic = zip(*sorted(zip(coefs, words), key=lambda x: x[0], reverse=False)[:200000])

# store our score in a variables 
f1__score = report['macro avg']['f1-score'] 
# print the score
print("{:.2f}".format(f1__score))
print(words[:5])
print(',',words_nontoxic[:5])
