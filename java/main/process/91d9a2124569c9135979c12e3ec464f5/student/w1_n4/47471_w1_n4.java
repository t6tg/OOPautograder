package week7;

public class Ex7_1 {

    public static void main(String[] args) {
        System.out.println(money(30));
    }

    public static float money(float n) {
        if(n == 0){
            return 10000;
        }
        return (float) (1.05 * money(n-1));
    }
}
